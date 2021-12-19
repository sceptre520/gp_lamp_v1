<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.avatarize.php 78605 2021-07-05 14:54:45Z rjsmelo $

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 * Name:     avatarize
 * Purpose:  show avatar for a given user name
 * -------------------------------------------------------------
 */
function smarty_modifier_avatarize($user, $float = '', $default = '', $show_tag = 'y')
{
    if (! $user) {
        return '';
    }

    $avatar = TikiLib::lib('tiki')->get_user_avatar($user, $float);

    if (! $avatar && $default) {
        $smarty = TikiLib::lib('smarty');
        $smarty->loadPlugin('smarty_function_icon');
        $name = TikiLib::lib('user')->clean_user($user);
        $avatar = smarty_function_icon(['_id' => $default, 'title' => $name], $smarty->getEmptyInternalTemplate());
    }

    if ($avatar != '' && $show_tag == 'y') {
        $avatar = TikiLib::lib('user')->build_userinfo_tag($user, $avatar);
    }
    return $avatar;
}
