<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Exception.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Math_Formula_Parser_Exception extends Math_Formula_Exception
{
    public function __construct($message, array $tokens, $code = null)
    {
        $message = tr('%0 near "%1"', $message, implode(' ', $tokens));
        parent::__construct($message, $code);
    }
}
