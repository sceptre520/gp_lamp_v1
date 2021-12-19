<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: middle.php 78605 2021-07-05 14:54:45Z rjsmelo $

function prefs_middle_list()
{
    return [
        'middle_shadow_start' => [
            'name' => tra('Middle shadow div start'),
            'type' => 'textarea',
            'size' => '2',
            'default' => '',
        ],
        'middle_shadow_end' => [
            'name' => tra('Middle shadow div end'),
            'type' => 'textarea',
            'size' => '2',
            'default' => '',
        ],
    ];
}
