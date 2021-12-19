{* $Id: medialist.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
<ul class="list-unstyled media-list">
    {foreach from=$results item=row}
        <li class="media">
            {if $icon and $icon.field}
                <img class="mr-3" src="{$row[$icon.field]}" alt="{tr}media image{/tr}">
            {/if}
            <div class="media-body">
                <h4 class="mt-0 mb-1">{object_link type=$row.object_type id=$row.object_id}</h4>
                {if $body and $body.field}
                    {if $body.mode eq 'raw'}
                        {$row[$body.field]}
                    {else}
                        {$row[$body.field]|escape}
                    {/if}
                {/if}
            </div>
        </li>
    {/foreach}
</ul>
{pagination_links resultset=$results}{/pagination_links}
