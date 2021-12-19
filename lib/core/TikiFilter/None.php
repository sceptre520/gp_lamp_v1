<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: None.php 78605 2021-07-05 14:54:45Z rjsmelo $

// Dummy filter (identity function)
class TikiFilter_None implements Laminas\Filter\FilterInterface
{
    public function filter($value)
    {
        return $value;
    }
}
