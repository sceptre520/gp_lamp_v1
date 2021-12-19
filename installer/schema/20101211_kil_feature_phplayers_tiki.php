<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: 20101211_kil_feature_phplayers_tiki.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @param $installer
 */
function upgrade_20101211_kil_feature_phplayers_tiki($installer)
{
    $result = $installer->getOne("SELECT COUNT(*) FROM `tiki_preferences` WHERE `name` = 'feature_phplayers' AND `value` =  'y'");
    if ($result > 0) {
        $installer->query("REPLACE `tiki_preferences` SET `name` = 'feature_cssmenus', `value` = 'y'; DELETE FROM `tiki_preferences` WHERE `name` = 'feature_phplayers';");
    }
}
