<?php

/**
 * @package tikiwiki
 */

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-mytiki_shared.php 78605 2021-07-05 14:54:45Z rjsmelo $

if ($prefs['feature_messages'] == 'y' && $tiki_p_messages == 'y') {
    $unread = $tikilib->user_unread_messages($user);
    $smarty->assign('unread', $unread);
}
