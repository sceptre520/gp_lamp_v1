<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-forums_best_voted_topics.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_forums_best_voted_topics_info()
{
    return [
        'name' => tra('Top-Rated Topics'),
        'description' => tra('Displays the specified number of the forum topics with the best ratings.'),
        'prefs' => ['feature_forums'],
        'params' => [],
        'common_params' => ['nonums', 'rows']
    ];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_forums_best_voted_topics($mod_reference, $module_params)
{
    $smarty = TikiLib::lib('smarty');
    global $ranklib;
    include_once('lib/rankings/ranklib.php');

    $ranking = $ranklib->forums_ranking_top_topics($mod_reference["rows"]);
    $smarty->assign('modForumsTopTopics', $ranking["data"]);
}
