<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: TimeLimit.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Tiki_TimeLimit
{
    public function __construct($targetLimit)
    {
        set_time_limit((int) $targetLimit);
    }
}
