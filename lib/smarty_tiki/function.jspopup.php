<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.jspopup.php 78605 2021-07-05 14:54:45Z rjsmelo $

function smarty_function_jspopup($params, $smarty)
{
    extract($params);
    // Param = zone
    if (empty($href)) {
        trigger_error("assign: missing href parameter");
        return;
    }
    if (! isset($scrollbars)) {
        $scrollbars = 'yes';
    }
    if (! isset($menubar)) {
        $menubar = 'no';
    }
    if (! isset($resizable)) {
        $resizable = 'yes';
    }
    if (! isset($height)) {
        $height = '400';
    }
    if (! isset($width)) {
        $width = '600';
    }
    print("href='#' onclick='javascript:window.open(\"$href\",\"\",\"menubar=$menubar,scrollbars=$scrollbars,resizable=$resizable,height=$height,width=$width\");' ");
}
