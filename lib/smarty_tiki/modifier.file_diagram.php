<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.file_diagram.php 78605 2021-07-05 14:54:45Z rjsmelo $

use Tiki\File\DiagramHelper;

/**
 * Checks if a given file id is a diagram
 */
function smarty_modifier_file_diagram($fileId)
{
    return DiagramHelper::isDiagram($fileId);
}
