<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: include_socialnetworks.php 78605 2021-07-05 14:54:45Z rjsmelo $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER['SCRIPT_NAME'], basename(__FILE__)) !== false) {
    header('location: index.php');
    exit;
}

require_once('tiki-setup.php');

require_once('lib/socnets/PrefsGen.php');
use TikiLib\Socnets\PrefsGen\PrefsGen;

$url = PrefsGen::getSocBaseUrl();
$smarty->assign('callbackUrl', $url);

$smarty->assign('socnetsAll', PrefsGen::getHybridProvidersPHP());
$smarty->assign('socBasePrefs', PrefsGen::getBasePrefs());
$smarty->assign('socPreffix', PrefsGen::getSocPreffix());

// legacy socialnetworks setup
require_once('lib/socialnetworkslib.php');
$url = $socialnetworkslib->getURL();
$url = substr($url, 0, strrpos($url, '/') + 1);
$smarty->assign('url', $url);
