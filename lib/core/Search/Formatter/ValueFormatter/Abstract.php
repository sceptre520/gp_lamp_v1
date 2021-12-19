<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Abstract.php 78605 2021-07-05 14:54:45Z rjsmelo $

abstract class Search_Formatter_ValueFormatter_Abstract implements Search_Formatter_ValueFormatter_Interface
{
    public function render($name, $value, array $entry)
    {
        return $value;
    }

    public function canCache()
    {
        return true;
    }
}
