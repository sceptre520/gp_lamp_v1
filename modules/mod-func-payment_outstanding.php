<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-payment_outstanding.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_payment_outstanding_info()
{
    return [
        'name' => tra('Payments Outstanding'),
        'description' => tra('Displays the payments outstanding for the current user.'),
        'prefs' => ['payment_feature'],
    ];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_payment_outstanding($mod_reference, $module_params)
{
    global $user, $prefs;

    $paymentlib = TikiLib::lib('payment');
    $smarty = TikiLib::lib('smarty');
    if ($user) {
        $data = $paymentlib->get_outstanding(0, $mod_reference['rows'], $user);
        $smarty->assign('outstanding', $data);
    }
}
