<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: index.php 78604 2021-07-05 14:35:54Z rjsmelo $

// This redirects to the sites root to prevent directory browsing
header("location: ../index.php");
die;
