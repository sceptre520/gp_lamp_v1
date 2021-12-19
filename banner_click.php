<?php

/**
 * @package tikiwiki
 */

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: banner_click.php 78605 2021-07-05 14:54:45Z rjsmelo $

$inputConfiguration = [
    [
        'staticKeyFilters' => [
            'id' => 'int',
        ]
    ]
];

require_once('tiki-setup.php');

$access->check_feature('feature_banners');

$bannerlib = TikiLib::lib('banner');

$info = $bannerlib->get_banner($_REQUEST['id']);
if ($info) {
    $bannerlib->add_click($info['bannerId']);
    $url = urldecode($info['url']);
    header("location: $url");
}
