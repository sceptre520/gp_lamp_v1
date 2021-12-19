<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: 20110610_readd_sefurl_index_left_tiki.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @param $installer
 */
function upgrade_20110610_readd_sefurl_index_left_tiki($installer)
{
    $result = $installer->fetchAll("SHOW INDEX FROM `tiki_sefurl_regex_out` WHERE `Key_name`='left'");

    if ($result) {
        $result = $installer->query("DROP INDEX `left` ON `tiki_sefurl_regex_out`");
    }
    $installer->query("ALTER TABLE `tiki_sefurl_regex_out` ADD UNIQUE `left` (`left`(128))");
}
