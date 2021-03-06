<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Indexable.php 78605 2021-07-05 14:54:45Z rjsmelo $

interface Tracker_Field_Indexable extends Tracker_Field_Interface
{
    public function getDocumentPart(Search_Type_Factory_Interface $typeFactory);

    public function getProvidedFields();

    public function getGlobalFields();

    public function getBaseKey();
}
