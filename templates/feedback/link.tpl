{* $Id: link.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

<div id="alert-wrapper">
    {foreach $fb as $item}
        {remarksbox type="{$item.type}" title="{$item.title}"}
            {if !empty($item.mes)}
                {$item.mes|escape}
            {/if}
            {if isset($item.items) && $item.items|count > 0}
                <ul>
                    <li>
                        {object_link type="wiki page" id="{$item.items|escape}"}
                    </li>
                </ul>
            {/if}
        {/remarksbox}
    {/foreach}
</div>
