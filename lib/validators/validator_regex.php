<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: validator_regex.php 78605 2021-07-05 14:54:45Z rjsmelo $

function validator_regex($input, $parameter = '', $message = '')
{
    $times = preg_match('/' . $parameter . '/', $input, $matches);
    if (! $times || $matches[0] != $input) {
        if ($message) {
            return tra($message);
        } else {
            return false;
        }
    } else {
        return true;
    }
}
