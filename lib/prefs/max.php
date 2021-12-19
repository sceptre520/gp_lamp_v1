<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: max.php 78605 2021-07-05 14:54:45Z rjsmelo $

function prefs_max_list()
{
    return [
        'max_username_length' => [
            'name' => tra('Maximum length'),
            'description' => tra('The greatest number of characters for a valid username.'),
            'type' => 'text',
            'size' => 5,
            'filter' => 'digits',
            'units' => tra('characters'),
            'default' => 50,
        ],
    ];
}
