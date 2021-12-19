<?php
/**
 * This redirects to the site's root to prevent directory browsing.
 *
 * @ignore
 * @package TikiWiki
 * @subpackage dump
 * @copyright (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
 * @licence Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
 */
// $Id: index.php 66118 2018-04-19 19:22:29Z luciash $

// This redirects to the sites root to prevent directory browsing
header("location: ../tiki-index.php");
die;
