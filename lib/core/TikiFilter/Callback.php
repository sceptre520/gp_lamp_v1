<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Callback.php 78605 2021-07-05 14:54:45Z rjsmelo $

class TikiFilter_Callback implements Laminas\Filter\FilterInterface
{
    private $callback;

    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    public function filter($value)
    {
        $f = $this->callback;

        return $f($value);
    }
}
