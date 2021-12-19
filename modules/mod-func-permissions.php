<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-permissions.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_permissions_info()
{
    return [
        'name' => tr('Permissions'),
        'description' => tr('List of active permissions for current object'),
        'params' => []
    ];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_permissions($mod_reference, $module_params)
{
    $modPermissions = new \Tiki\Modules\Permissions();
    $pagePermissions = $modPermissions->getPagePermissions();

    if ($pagePermissions == null) {
        return false;
    }

    $smarty = TikiLib::lib('smarty');
    $smarty->assign('pagePermissions', $pagePermissions);
}
