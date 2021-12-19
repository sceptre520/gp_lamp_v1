<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id$

namespace Tracker\Tabular;

class ODBCManager
{
    private $config;
    private $errors;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getSchema()
    {
        $result = [];
        $this->handleErrors();
        $conn = $this->getConnection();
        $columns = odbc_columns($conn, $this->getCatalog(), '%', $this->config['table'], '%');
        while ($row = odbc_fetch_array($columns)) {
            $result[] = $row;
        }
        $this->stopErrorHandler();
        return $result;
    }

    public function iterate($fields, $modifiedField = null, $lastImport = null)
    {
        $this->handleErrors();
        $conn = $this->getConnection();
        $select = implode('", "', $fields);
        $sql = "SELECT \"{$select}\" FROM {$this->config['table']}";
        if ($modifiedField && $lastImport) {
            $sql .= " WHERE \"{$modifiedField}\" >= ?";
            $rs = odbc_prepare($conn, $sql);
            odbc_execute($rs, [$lastImport]);
        } else {
            $rs = odbc_exec($conn, $sql);
        }
        while ($row = odbc_fetch_array($rs)) {
            yield $row;
        }
        $this->stopErrorHandler();
    }

    public function replace($pk, $id, $row)
    {
        $this->handleErrors();
        $conn = $this->getConnection();
        if ($id) {
            $sql = "SELECT \"{$pk}\" FROM {$this->config['table']} WHERE \"{$pk}\" = ?";
            $rs = odbc_prepare($conn, $sql);
            odbc_execute($rs, [$id]);
            $exists = odbc_num_rows($rs) > 0;
        } else {
            $exists = false;
            $id = null;
        }
        if ($exists) {
            foreach (array_chunk($row, 50, true) as $chunk) {
                $sql = "UPDATE {$this->config['table']} SET " . implode(', ', array_map(function ($k) {
                    return "\"{$k}\" = ?";
                }, array_keys($chunk))) . " WHERE \"{$pk}\" = ?";
                $rs = odbc_prepare($conn, $sql);
                $params = array_map(function ($v) {
                    return empty($v) && $v !== '0' ? null : $v;
                }, array_values($chunk));
                $params[] = $id;
                odbc_execute($rs, $params);
                if (odbc_error()) {
                    $this->errors[] = tr("Error updating remote item: %0", odbc_errormsg());
                }
            }
            $sql = "SELECT * FROM {$this->config['table']} WHERE \"{$pk}\" = ?";
            $rs = odbc_prepare($conn, $sql);
            odbc_execute($rs, [$id]);
            $result = odbc_fetch_array($rs);
        } else {
            $row = array_filter($row);
            $sql = "INSERT INTO {$this->config['table']}(\"" . implode('", "', array_keys($row)) . "\") VALUES (" . implode(", ", array_fill(0, count(array_keys($row)), '?')) . ")";
            $rs = odbc_prepare($conn, $sql);
            odbc_execute($rs, array_values($row));
            if (odbc_error()) {
                $this->errors[] = tr("Error inserting remote item: %0", odbc_errormsg());
            }
            $sql = "SELECT * FROM {$this->config['table']} WHERE \"{$pk}\" = @@IDENTITY";
            $rs = odbc_prepare($conn, $sql);
            odbc_execute($rs, []);
            $result = odbc_fetch_array($rs);
        }
        $this->stopErrorHandler();
        return $result;
    }

    public function replaceWithoutPK($existing, $row)
    {
        if (empty($existing)) {
            return $row;
        }
        $this->handleErrors();
        $conn = $this->getConnection();
        foreach (array_chunk($row, 50, true) as $chunk) {
            $sql = "UPDATE {$this->config['table']} SET " . implode(', ', array_map(function ($k) {
                return "\"{$k}\" = ?";
            }, array_keys($chunk))) . " WHERE " . implode(' AND ', array_map(function ($k, $v) {
                return empty($v) ? "\"{$k} IS NULL\"" : "\"{$k}\" = ?";
            }, array_keys($existing), $existing));
            $rs = odbc_prepare($conn, $sql);
            $params = array_map(function ($v) {
                return empty($v) && $v !== '0' ? null : $v;
            }, array_values($chunk));
            $params = array_merge($params, array_filter(array_values($existing)));
            odbc_execute($rs, $params);
            if (odbc_error()) {
                $this->errors[] = tr("Error updating remote item: %0", odbc_errormsg());
            }
        }
        foreach ($row as $k => $v) {
            $existing[$k] = $v;
        }
        $sql = "SELECT * FROM {$this->config['table']} WHERE " . implode(' AND ', array_map(function ($k, $v) {
            return empty($v) ? "\"{$k} IS NULL\"" : "\"{$k}\" = ?";
        }, array_keys($existing), $existing));
        $rs = odbc_prepare($conn, $sql);
        $params = array_filter(array_values($existing));
        odbc_execute($rs, $params);
        $result = odbc_fetch_array($rs);
        $this->stopErrorHandler();
        return $result;
    }

    public function delete($pk, $id)
    {
        $this->handleErrors();
        $conn = $this->getConnection();
        $sql = "DELETE FROM {$this->config['table']} WHERE \"{$pk}\" = ?";
        $rs = odbc_prepare($conn, $sql);
        odbc_execute($rs, [$id]);
        if (odbc_error()) {
            $this->errors[] = tr("Error deleting remote item: %0", odbc_errormsg());
        }
        $this->stopErrorHandler();
    }

    private function getConnection()
    {
        return odbc_connect($this->config['dsn'], $this->config['user'], $this->config['password']);
    }

    private function getCatalog()
    {
        if (preg_match('/Database=(.*);/i', $this->config['dsn'], $m)) {
            return $m[1];
        } else {
            return '';
        }
    }

    private function handleErrors()
    {
        $this->orig_handler = set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            $this->errors[] = $errstr;
        });
    }

    private function stopErrorHandler()
    {
        set_error_handler($this->orig_handler);
        if ($this->errors) {
            throw new \Exception(implode(' ', $this->errors));
        }
    }
}
