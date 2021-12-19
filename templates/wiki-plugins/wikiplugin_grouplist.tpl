{* $Id: wikiplugin_grouplist.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{if empty($groups)}
    &mdash;
{else}
    <ul>
    {foreach from=$groups item=group}
        <li>
        {if $params.linkhome eq 'y' && !empty($group.groupHome)}
            <a href="{$group.groupHome|sefurl:wiki}">
            {assign var=link value='y'}
        {/if}
        {$group.groupName|escape}
        {if !empty($link)}
            </a>
        {/if}
        </li>
    {/foreach}
    </ul>
{/if}
