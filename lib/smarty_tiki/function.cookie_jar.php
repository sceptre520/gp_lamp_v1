<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.cookie_jar.php 78616 2021-07-05 18:03:12Z jonnybradley $

/*
 * smarty_function_cookie_jar: Get a cookie value from the Tiki Cookie Jar
 *
 * params:
 *    - name: Name of the cookie
 */
function smarty_function_cookie_jar($params, $smarty)
{
    if (empty($params['name'])) {
        return;
    }
    return getCookie($params['name']);
}
