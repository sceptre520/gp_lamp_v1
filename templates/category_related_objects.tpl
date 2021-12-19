{* $Id: category_related_objects.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{if !empty($category_related_objects)}
<div class="related">
    <h4>{tr}Related content{/tr}</h4>
    <ul>
    {foreach from=$category_related_objects item=object}
        <li><a href="{$object.href|escape}">{$object.name|escape}</a></li>
    {/foreach}
    </ul>
</div>
{/if}
