<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-since_last_visit.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_since_last_visit_info()
{
    return [
        'name' => tra('Since Last Visit (Simple)'),
        'description' => tra('Displays to logged-in users the number of new or updated objects since their last login date and time.')
    ];
}

/**
 * @param $mod_reference
 * @param null $params
 */
function module_since_last_visit($mod_reference, $params = null)
{
    global $user;
    $smarty = TikiLib::lib('smarty');
    $tikilib = TikiLib::lib('tiki');

    $nvi_info = $tikilib->get_news_from_last_visit($user);
    $smarty->assign('nvi_info', $nvi_info);
    $smarty->assign('tpl_module_title', tra('Since your last visit'));
}
