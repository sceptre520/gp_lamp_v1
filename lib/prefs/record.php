<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: record.php 78605 2021-07-05 14:54:45Z rjsmelo $

function prefs_record_list()
{
    return [
        'record_untranslated' => [
            'name' => tra('Record untranslated strings'),
            'description' => tra('Keep track of the unsuccessful attemps to translate strings.'),
            'type' => 'flag',
            'default' => 'n',
        ],
    ];
}
