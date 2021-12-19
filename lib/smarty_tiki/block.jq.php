<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: block.jq.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 *
 * \brief Smarty {jq} block handler
 *
 * Creates JQuery javascript if enabled
 * Defaults to execute on DOM ready
 * The content script is automatically escaped with {literal}{/literal} unless the tag is already in there.
 * To "unescape" back to smarty synax use {{ to start, and }} to stop. See examples below.
 *
 * Usage:
 *    {jq [notonready=false|true], [nojquery='Optional markup for when feature_jquery is off']}
 *        $("#exampleId").hide()
 *    {/jq}
 *
 * Examples:
 *
 *  Simple, no escaping - result wrapped in {literal}{/literal}
 *    {jq}$(#exampleId").click(function() { alert("Clicked!"); });{/jq}
 *
 *  Smarty markup between {{ and }} - result parsed and wrapped in literals
 *    {jq}$(#exampleId").show({{if $animation_fast eq 'y'}"fast"{else}"slow"{/if}}){/jq}
 *
 *  Escaped already - not re-parsed, not wrapped in literals
 *    {jq}{literal}$(#exampleId").show({/literal}{if $animation_fast eq 'y'}"fast"{else}"slow"{/if}){/jq}
 */
/**
 * @param array                    $params
 * @param string|null              $content
 * @param Smarty_Internal_Template $smarty
 * @param bool                     $repeat
 *
 * @return string
 * @throws Exception
 */

function smarty_block_jq(array $params, ?string $content, Smarty_Internal_Template $smarty, bool &$repeat): string
{
    if ($repeat || empty($content)) {
        return '';
    }

    global $prefs;
    if ($prefs['feature_jquery'] !== 'y') {
        return $params['nojquery'] ?? tr('<!-- jq smarty plugin inactive: feature_jquery off -->');
    }
    /** @var \headerlib $headerlib */
    $headerlib = TikiLib::lib('header');

    $params['rank'] = $params['rank'] ?? 0;

    if (empty($params['notonready'])) {
        $headerlib->add_jq_onready($content, $params['rank']);
    } else {
        $headerlib->add_js($content, $params['rank']);
    }
    return '';
}
