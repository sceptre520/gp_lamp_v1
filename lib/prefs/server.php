<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: server.php 78605 2021-07-05 14:54:45Z rjsmelo $

function prefs_server_list($partial = false)
{

    // Skipping the getTimeZoneList() from tikidate which just emulates the pear date format
    // Generating it is extremely costly in terms of memory.
    if (class_exists('DateTimeZone')) {
        $timezones = DateTimeZone::listIdentifiers();
    } elseif (class_exists('DateTime')) {
        $timezones = array_keys(DateTime::getTimeZoneList());
    } else {
        $timezones = TikiDate::getTimeZoneList();
        $timezones = array_keys($timezones);
    }

    sort($timezones);

    $tikidate = TikiLib::lib('tikidate');

    return [
        'server_timezone' => [
            'name' => tra('Time zone'),
            'description' => tra('Indicates the default time zone to use for the server.'),
            'type' => 'list',
            'options' => array_combine($timezones, $timezones),
            'default' => isset($tikidate) ? $tikidate->getTimezoneId() : 'UTC',
            'tags' => ['basic'],
        ],
    ];
}
