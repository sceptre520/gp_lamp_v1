<?php
// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: index.php 66114 2018-04-19 18:54:32Z luciash $

// This redirects to the sites root to prevent directory browsing
header("location: ../../tiki-index.php");
die;
