<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Interface.php 78605 2021-07-05 14:54:45Z rjsmelo $

interface Search_Index_Interface
{
    public function addDocument(array $document);

    public function invalidateMultiple(array $query);

    public function endUpdate();

    public function find(Search_Query_Interface $query, $resultStart, $resultCount);

    public function getTypeFactory();

    public function optimize();

    public function destroy();

    public function exists();
}
