<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-google.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_google_info()
{
    return [
        'name' => tra('Google Search'),
        'description' => tra('Displays a simple form to search on Google. By default, search results are limited to those on the Tiki site.'),
        'prefs' => [],
        'params' => []
    ];
}
