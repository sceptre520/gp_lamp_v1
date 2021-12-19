<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: 20110609_unique_login_tiki.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @param $installer
 */
function upgrade_20110609_unique_login_tiki($installer)
{
    $result = $installer->query("select count(*) nb from users_users group by login having count(*) > 1");
    $row = $result->fetchRow();

    if ((int)$row['nb'] == 0) {
        $result = $installer->query("drop index login on users_users");
        $result = $installer->query("alter table users_users add unique login (login)");
    }
}
