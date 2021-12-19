<?php

/**
 * This redirects to the site's root to prevent directory browsing.
 *
 * @ignore
 * @package TikiWiki
 * @subpackage css
 * @copyright (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
 * @licence Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
 */

// $Id: index.php 78604 2021-07-05 14:35:54Z rjsmelo $

// This redirects to the sites root to prevent directory browsing
header("location: ../index.php");
die;
