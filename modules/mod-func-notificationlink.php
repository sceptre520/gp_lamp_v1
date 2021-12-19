<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-notificationlink.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_notificationlink_info()
{
    return [
        'name' => tra('Notifications Link'),
        'description' => tra('Shows an icon with the number of and a link to user notifications'),
        'prefs' => ['monitor_enabled'],
        'params' => [],
    ];
}
