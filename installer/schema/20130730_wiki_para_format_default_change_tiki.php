<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: 20130730_wiki_para_format_default_change_tiki.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * default for feature_wiki_paragraph_formatting changed between tiki 11 and 12 - this maintains previous default setting
 *
 * @param $installer
 */
function upgrade_20130730_wiki_para_format_default_change_tiki($installer)
{
    $value = $installer->getOne("SELECT `value` FROM `tiki_preferences` WHERE `name` = 'feature_wiki_paragraph_formatting'");

    if ($value !== 'y') {   // default values can be empty
        $preferences = $installer->table('tiki_preferences');
        $preferences->insertOrUpdate(['value' => 'n'], ['name' => 'feature_wiki_paragraph_formatting']);
    }
}
