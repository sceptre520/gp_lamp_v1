<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.username.php 78605 2021-07-05 14:54:45Z rjsmelo $

function smarty_modifier_username($user, $login_fallback = true, $check_user_show_realnames = true, $html_encoding = true)
{
    global $prefs;
    $userlib = TikiLib::lib('user');

    $return = $userlib->clean_user($user, ! $check_user_show_realnames, $login_fallback);

    if ($html_encoding) {
        $return = htmlspecialchars($return);
    }
    return $return;
}
