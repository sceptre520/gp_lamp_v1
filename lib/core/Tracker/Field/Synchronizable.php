<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Synchronizable.php 78605 2021-07-05 14:54:45Z rjsmelo $

interface Tracker_Field_Synchronizable extends Tracker_Field_Interface
{
    public function importRemote($value);

    public function exportRemote($value);

    public function importRemoteField(array $info, array $syncInfo);
}
