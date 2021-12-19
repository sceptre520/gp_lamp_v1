<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.countryflag.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * \brief Smarty modifier plugin to add user's country flag
 *
 * - type:     modifier
 * - name:     countryflag
 * - purpose:  Returns a specified user's country flag
 *
 * @author
 * @param string
 * @return string
 *
 * Example: {$userinfo.login|countryflag}
 */

function smarty_modifier_countryflag($user)
{
    global $tikilib;
    $flag = $tikilib->get_user_preference($user, 'country', 'Other');
    if ($flag == 'Other' || empty($flag)) {
        return '';
    }
    return "<img alt='" . tra(str_replace('_', ' ', $flag)) . "' src='img/flags/" . str_replace(' ', '_', $flag) .
        ".png' title='" . tra(str_replace('_', ' ', $flag)) . "' />";
}
