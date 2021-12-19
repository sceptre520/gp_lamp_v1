<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.reindex_file_pixel.php 78605 2021-07-05 14:54:45Z rjsmelo $

/*
 * smarty_function_reindex_file_pixel: Display a 1x1 transparent gif image that will start a background reindexation process of a file
 *
 * params:
 *  - id: id of the file to reindex
 */
function smarty_function_reindex_file_pixel($params, $smarty)
{
    if (! is_array($params) || ! isset($params['id']) || ( $id = (int) $params['id'] ) <= 0) {
        return '';
    }

    global $tikiroot;
    return '<img src="' . $tikiroot . 'reindex_file.php?id=' . $id . '" width="1" height="1" />';
}
