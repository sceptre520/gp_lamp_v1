<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.redirect.php 78605 2021-07-05 14:54:45Z rjsmelo $

function smarty_function_redirect($params, $smarty)
{
    global $user;

    extract($params, EXTR_SKIP);
    // Param = url
    if (empty($url)) {
        trigger_error("assign: missing parameter: url");
        return;
    }
    if (empty($user) && empty($_SESSION['loginfrom'])) {
        // user in error.tpl when permission is denied for anonymous
        $_SESSION['loginfrom'] = $_SERVER['REQUEST_URI'];
    }
    header("Location: $url");
    exit;
}
