<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-rsslist.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_rsslist_info()
{
    return [
        'name' => tra('News Feeds'),
        'description' => tra('List of feeds available on this site.'),
        'prefs' => [],
    ];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_rsslist($mod_reference, $module_params)
{
}
