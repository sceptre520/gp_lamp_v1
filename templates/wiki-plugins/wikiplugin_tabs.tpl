{* $Id: wikiplugin_tabs.tpl 78611 2021-07-05 17:11:28Z jonnybradley $
 * smarty template for tabs wiki plugin
 *}
{if isset($is_slideshow) and $is_slideshow eq 'y'}
    {foreach from=$tabs key=i item=tab}
        {$tabcontent[$i]}
    {/foreach}
{else}
~np~{tabset toggle=$toggle name=$tabsetname|escape}
    {section name=ix loop=$tabs}{tab name=$tabs[ix]|escape}{$tabcontent[ix]}{/tab}{/section}
{/tabset}~/np~
{/if}
