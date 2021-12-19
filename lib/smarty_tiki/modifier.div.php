<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.div.php 78605 2021-07-05 14:54:45Z rjsmelo $

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 *
 * -------------------------------------------------------------
 */
function smarty_modifier_div($string, $num, $max = 10)
{
    if ($num == 0) {
        return 0;
    }

    if (ceil(strlen($string) / $num) > $max) {
        return $max;
    }

    return ceil(strlen($string) / $num);
}
