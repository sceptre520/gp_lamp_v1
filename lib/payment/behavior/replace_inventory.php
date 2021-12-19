<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: replace_inventory.php 78605 2021-07-05 14:54:45Z rjsmelo $

function payment_behavior_replace_inventory($code, $quantity)
{
    $cartlib = TikiLib::lib('cart');
    $cartlib->change_inventory($code, $quantity);
    return true;
}
