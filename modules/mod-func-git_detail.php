<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-git_detail.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * Return module information
 *
 * @return array
 */
function module_git_detail_info()
{
    return [
        'name' => tra('GIT detail'),
        'description' => tra('GIT commit and last update information.'),
        'params' => [],
    ];
}

/**
 * Collect information about current git repository and assign information
 * on smarty template engine
 *
 * @param $mod_reference
 * @param $module_params
 */
function module_git_detail($mod_reference, $module_params)
{
    $smarty = TikiLib::lib('smarty');
    $gitlib = TikiLib::lib('git');
    $error = '';
    $content = [];

    try {
        $content = $gitlib->get_info();
    } catch (Exception $e) {
        $error = $e->getMessage();
    } catch (Error $e) {
        $error = $e->getMessage();
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }

    $smarty->assign('error', $error);
    $smarty->assign('content', $content);
}
