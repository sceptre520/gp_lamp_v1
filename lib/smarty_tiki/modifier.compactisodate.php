<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.compactisodate.php 78605 2021-07-05 14:54:45Z rjsmelo $

// this returns the compact ISO 8601 date for microformats
function smarty_modifier_compactisodate($string)
{
    global $tikilib;
    return $tikilib->get_compact_iso8601_datetime($string);
}
