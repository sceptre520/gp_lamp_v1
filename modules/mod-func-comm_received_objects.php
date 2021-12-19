<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-comm_received_objects.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_comm_received_objects_info()
{
    return [
        'name' => tra('Received Objects'),
        'description' => tra('Displays the number of pages received (via Communications).'),
        'prefs' => ["feature_comm"],
        'documentation' => 'Module comm_received_objects',
        'params' => []
    ];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_comm_received_objects($mod_reference, $module_params)
{
    $tikilib = TikiLib::lib('tiki');
    $smarty = TikiLib::lib('smarty');
    $ranking = $tikilib->list_received_pages(0, -1, 'pageName_asc');

    $smarty->assign('modReceivedPages', $ranking["cant"]);
}
