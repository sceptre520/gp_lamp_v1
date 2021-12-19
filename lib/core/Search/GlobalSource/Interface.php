<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Interface.php 78605 2021-07-05 14:54:45Z rjsmelo $

interface Search_GlobalSource_Interface
{
    public function getData($objectType, $objectId, Search_Type_Factory_Interface $typeFactory, array $data = []);

    public function getProvidedFields();

    public function getGlobalFields();
}