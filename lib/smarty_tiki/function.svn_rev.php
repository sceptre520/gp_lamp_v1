<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.svn_rev.php 78605 2021-07-05 14:54:45Z rjsmelo $

function smarty_function_svn_rev()
{
    $svn = svn_last_update();
    return isset($svn['svnrev']) ? $svn['svnrev'] : null;
}
