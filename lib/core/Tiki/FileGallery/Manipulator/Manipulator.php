<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Manipulator.php 78605 2021-07-05 14:54:45Z rjsmelo $

namespace Tiki\FileGallery\Manipulator;

use Tiki\FileGallery\File;

abstract class Manipulator
{
    /** @var File */
    protected $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    abstract public function run($args);
}
