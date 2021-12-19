<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.max_user_inscriptions.php 78605 2021-07-05 14:54:45Z rjsmelo $

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 * Name:     max_user_inscriptions
 * Purpose:  to use with the tracker field type "User inscription"
 * -------------------------------------------------------------
 */
function smarty_modifier_max_user_inscriptions($text)
{
    return substr($text, 0, strpos($text, '#'));
}
