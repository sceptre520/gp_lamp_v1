<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: QuerySourceEntry.php 79238 2021-11-09 16:10:23Z kroky6 $

namespace Tracker\Tabular\Source;

class QuerySourceEntry implements SourceEntryInterface
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function render(\Tracker\Tabular\Schema\Column $column, $allow_multiple)
    {
        $field = $column->getField();
        $key = 'tracker_field_' . $field;

        if (isset($this->data[$key])) {
            $value = $this->data[$key];
        } else {
            $value = null;
        }

        $extra = [];
        foreach ($column->getQuerySources() as $target => $field) {
            if (isset($this->data[$field])) {
                $extra[$target] = $this->data[$field];
            }
        }

        return $column->render($value, array_merge($extra, ['allow_multiple' => $allow_multiple]));
    }
}
