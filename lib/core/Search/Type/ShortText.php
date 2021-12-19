<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ShortText.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Search_Type_ShortText implements Search_Type_Interface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return TikiLib::strtolower($this->value);
    }
}
