<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.wikistructure.php 78605 2021-07-05 14:54:45Z rjsmelo $

//copy this file to lib/smarty_tiki
//create a new module and put the following
//{wikistructure id=1 detail=1}
//id for structure id, or page_ref_id
//detail if you only wanna display subbranches of the open node within the structure
// assign your module

function smarty_function_wikistructure($params, $smarty)
{
    include_once('lib/wiki-plugins/wikiplugin_toc.php');

    if (! empty($params['id'])) {
        $params['structId'] = $params['id'];
    }
    $html = wikiplugin_toc('', $params);
    $html = str_replace(['~np~', '~/np~'], '', $html);
    return $html;
}
