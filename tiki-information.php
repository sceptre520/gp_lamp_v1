<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-information.php 78605 2021-07-05 14:54:45Z rjsmelo $

require_once('tiki-setup.php');
if (isset($_REQUEST['msg'])) {
    $smarty->assign('msg', $_REQUEST['msg']);
}
if (isset($_REQUEST['show_history_back_link'])) {
    $smarty->assign('show_history_back_link', $_REQUEST['show_history_back_link']);
}
$smarty->assign('mid', 'tiki-information.tpl');
$smarty->display("tiki.tpl");
