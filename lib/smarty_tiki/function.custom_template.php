<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.custom_template.php 78605 2021-07-05 14:54:45Z rjsmelo $
if (strpos($_SERVER['SCRIPT_NAME'], basename(__FILE__)) !== false) {
    header('location: index.php');
    exit;
}

function smarty_function_custom_template($params, $smarty)
{
    return TikiLib::custom_template($params['basetpl'], $params['modifiers']);
}
