<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: block.accordion.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 *
 * \brief smarty_block_tabs : add tabs to a template
 *
 * params: name (optional but unique per page if set)
 * params: toggle=y on n default
 *
 * usage:
 * \code
 *  {accordion}
 *      {accordion_group title="{tr}Title 1{/tr}"}tab content{/accordion_group}
 *      {accordion_group title="{tr}Title 2{/tr}"}tab content{/accordion_group}
 *  {/accordion}
 * \endcode
 */
function smarty_block_accordion($params, $content, $smarty, &$repeat)
{
    global $accordion_current_group;

    if ($repeat) {
        $accordion_current_group = null;
        return;
    } else {
        return <<<CONTENT
<div class="accordian" id="$accordion_current_group">
$content
</div>
CONTENT;
    }
}
