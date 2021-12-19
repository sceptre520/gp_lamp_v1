<?php

/**
 * @package tikiwiki
 */

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: show_image.php 78725 2021-07-26 09:48:45Z jonnybradley $

if (! isset($_REQUEST["nocache"])) {
    session_cache_limiter('private_no_expire');
}

global $tiki_p_admin, $prefs, $tikilib, $tikipath;

include_once("tiki-setup.php");

if ($prefs['feature_file_galleries'] == 'y' && $prefs['file_galleries_redirect_from_image_gallery'] == 'y') {

    $fileInfo = $tikilib->table('tiki_object_attributes')->fetchRow([], ['value' => $_REQUEST["id"], 'attribute' => 'tiki.file.imageid']);
    if ($fileInfo) {
        include_once($tikipath . 'tiki-sefurl.php');
        $newUrl = filter_out_sefurl('tiki-download_file.php?fileId=' . $fileInfo['itemId'] . '&display');

        if ($tiki_p_admin === 'y') {
            Feedback::warning(tr('Image Galleries have been migrated but show_image.php is still in use.%0 Change "%1" to "%2"',
                '<br>', 'show_image.php?id=' . $_REQUEST['id'], $newUrl
            ));
        }

        TikiLib::lib('access')->redirect($newUrl);

    } else {
        Feedback::error(tr('File info not found for migrated image gallery file #%0', $_REQUEST["id"]));
    }
} else if ($tiki_p_admin === 'y') {
    Feedback::error(tr('Image Galleries have been removed. Run the migration script: `php console.php gallery:migrate`'));
}

