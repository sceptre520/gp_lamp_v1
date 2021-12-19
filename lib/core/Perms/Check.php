<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Check.php 78605 2021-07-05 14:54:45Z rjsmelo $

interface Perms_Check
{
    public function check(Perms_Resolver $resolver, array $context, $name, array $groups);

    public function applicableGroups(Perms_Resolver $resolver);
}
