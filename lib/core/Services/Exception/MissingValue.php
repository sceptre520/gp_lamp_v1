<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: MissingValue.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Services_Exception_MissingValue extends Services_Exception_FieldError
{
    public function __construct($field)
    {
        parent::__construct($field, tr('Field Required'));
    }
}
