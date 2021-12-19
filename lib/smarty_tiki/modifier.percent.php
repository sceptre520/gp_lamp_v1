<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.percent.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 *
 * returns a percentage instead of a fraction
 * @param float $string fraction to format
 */
function smarty_modifier_percent($string)
{
    return number_format($string * 100, 1);
}
