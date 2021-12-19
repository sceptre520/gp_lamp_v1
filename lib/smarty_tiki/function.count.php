<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.count.php 78605 2021-07-05 14:54:45Z rjsmelo $

function smarty_function_count($params, $smarty)
{
    extract($params);
    if (empty($var)) {
        trigger_error("count: missing 'var' parameter");
        return;
    }
    print(count($var));
}
