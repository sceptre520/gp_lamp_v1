<?php

/**
 * @package tikiwiki
 */

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-wikiplugin_edit.php 78604 2021-07-05 14:35:54Z rjsmelo $

require 'tiki-setup.php';

trigger_error(tr('Note, deprecated file tiki-wikiplugin_edit.php, code moved to service plugin->replace'));

TikiLib::lib('service')->render('plugin', 'replace', $jitPost);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
