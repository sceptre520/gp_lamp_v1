<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.modulelist.php 78616 2021-07-05 18:03:12Z jonnybradley $

function smarty_function_modulelist($params, $smarty)
{
    $moduleZones = $smarty->getTemplateVars('module_zones');

    global $prefs;
    if (empty($params['zone'])) {
        return tr("Missing %0 parameter", 'zone');
    }

    $zone = $params['zone'];

    $tag = "div";
    $class = 'modules';
    if (! empty($params['class'])) {
        $class .= ' ' . $params['class'];
        if (strpos($class, 'navbar') !== false) {
            $tag = 'nav';
        }
    }

    $id = $zone . '_modules';
    if (! empty($params['id'])) {
        $id = $params['id'];
    }

    $dir = '';
    if (Language::isRTL()) {
        $dir = ' dir="rtl"';
    }

    $content = '';
    $key = $zone . '_modules';
    if (isset($moduleZones[$key]) && is_array($moduleZones[$key])) {
        $content = implode(
            '',
            array_map(
                function ($module) {
                    return (isset($module['data']) ? $module['data'] : '');
                },
                $moduleZones[$key]
            )
        );
    }
    return <<<OUT
<$tag class="$class" id="$id"$dir>
    $content
</$tag>
OUT;
}
