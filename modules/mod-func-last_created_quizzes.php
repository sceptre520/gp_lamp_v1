<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-last_created_quizzes.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_last_created_quizzes_info()
{
    return [
        'name' => tra('Newest Quizzes'),
        'description' => tra('Displays the specified number of quizzes from newest to oldest.'),
        'prefs' => ["feature_quizzes"],
        'params' => [],
        'common_params' => ['nonums', 'rows']
    ];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_last_created_quizzes($mod_reference, $module_params)
{
    $smarty = TikiLib::lib('smarty');
    $ranking = TikiLib::lib('quiz')->list_quizzes(0, $mod_reference["rows"], 'created_desc', '');

    $smarty->assign('modLastCreatedQuizzes', $ranking["data"]);
}
