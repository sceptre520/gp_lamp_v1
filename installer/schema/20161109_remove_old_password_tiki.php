<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: 20161109_remove_old_password_tiki.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * This removes the now unused password filed from the database, if it exists.
 *
 * @param $installer
 */
function upgrade_20161109_remove_old_password_tiki($installer)
{
    $query = "SHOW COLUMNS FROM `users_users` LIKE 'password'";
    $result = $installer->query($query, []);
    if ($result->numRows()) {
        $query = 'ALTER TABLE `users_users` DROP `password`';
        $installer->query($query, []);
    }
}
