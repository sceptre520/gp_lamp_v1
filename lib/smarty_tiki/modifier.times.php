<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.times.php 78605 2021-07-05 14:54:45Z rjsmelo $

function smarty_modifier_times($n1, $n2)
{
    return $n1 * $n2;
}
