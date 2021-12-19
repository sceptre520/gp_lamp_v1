<?php
/**
 * This redirects to the site's root to prevent directory browsing.
 *  
 * @ignore 
 * @package TikiWiki
 * @subpackage doc
 * @copyright (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
 * @licence Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
 */
// $Id: index.php 66114 2018-04-19 18:54:32Z luciash $

header("location: ../tiki-index.php");
die;
