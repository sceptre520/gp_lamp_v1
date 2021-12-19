<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Category.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Perms_Reflection_Category extends Perms_Reflection_Object
{
    public function getParentPermissions()
    {
        return $this->factory->get('global', null)->getDirectPermissions();
    }
}
