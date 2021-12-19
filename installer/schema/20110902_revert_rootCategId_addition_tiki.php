<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: 20110902_revert_rootCategId_addition_tiki.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @param $installer
 */
function upgrade_20110902_revert_rootCategId_addition_tiki($installer)
{
    $result = $installer->fetchAll("SHOW COLUMNS FROM `tiki_categories` WHERE `Field`='rootCategId'");
    if ($result) {
        $result = $installer->query("ALTER TABLE `tiki_categories` DROP COLUMN `rootCategId`;");
    }
}
