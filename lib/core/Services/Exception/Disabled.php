<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Disabled.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Services_Exception_Disabled extends Services_Exception
{
    public static function check($preference)
    {
        global $prefs;

        if ($prefs[$preference] != 'y') {
            throw new self($preference);
        }
    }

    public function __construct($preference)
    {
        parent::__construct(tr('Feature disabled: %0', $preference), 403);
    }
}
