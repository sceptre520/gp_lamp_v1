<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.tr_if.php 78605 2021-07-05 14:54:45Z rjsmelo $

// Translate only if feature_multilingual is on

function smarty_modifier_tr_if($source)
{
    global $prefs;
    $args = array_slice(func_get_args(), 1);

    if ($prefs['language'] != 'en') {
        include_once('lib/init/tra.php');
        return tra($source, '', false, $args);
    } else {
        $replace = array_values($args);
        $search = array_map(
            function ($arg) {
                return '%' . $arg;
            },
            array_keys($args)
        );
        return str_replace($search, $replace, $source);
    }
}
