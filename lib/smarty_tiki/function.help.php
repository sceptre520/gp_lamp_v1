<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.help.php 78605 2021-07-05 14:54:45Z rjsmelo $

function smarty_function_help($params, $smarty)
{
    extract($params);
    // Param = zone
    if (empty($url) && empty($desc) && empty($crumb)) {
        trigger_error("assign: missing parameter: help (url desc)|crumb");
        return;
    }
    print help_doclink($params);
}
