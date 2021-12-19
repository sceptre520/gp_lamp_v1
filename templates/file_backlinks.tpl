{* $Id: file_backlinks.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
<ul>
    {foreach from=$backlinks item=object}
        <li><a href="{$object.itemId|sefurl:$object.type}">{$object.name|escape}</a></li>
    {/foreach}
</ul>
