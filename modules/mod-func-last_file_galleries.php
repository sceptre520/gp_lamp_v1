<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-last_file_galleries.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @return array
 */
function module_last_file_galleries_info()
{
    return [
        'name' => tra('Last-Modified File Galleries'),
        'description' => tra('Display the specified number of file galleries, starting from the most recently modified.'),
        'prefs' => ["feature_file_galleries"],
        'params' => [],
        'common_params' => ['nonums', 'rows']
    ];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_last_file_galleries($mod_reference, $module_params)
{
    $smarty = TikiLib::lib('smarty');
    global $prefs;
    $filegallib = TikiLib::lib('filegal');
    $ranking = $filegallib->get_files(0, $mod_reference["rows"], 'lastModif_desc', null, $prefs['fgal_root_id'], false, true, false, false);

    $smarty->assign('modLastFileGalleries', $ranking["data"]);
}
