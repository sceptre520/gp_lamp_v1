<a name="list_filter{$filterCounter}"></a>
<div class="list_filter" id="list_filter{$filterCounter}">
    <form action="{$filterUrl}#list_filter{$filterCounter}" method="post">
        <table class="table">
        {foreach from=$filterFields item=field}
        <tr>
            <td class="list_filter_label">
                <label for="{$filter.id|escape}">{$field.name|tr_if}</label>
                {if $field.textInput}
                    {if $field.type == 'f'}
                        <a href="#" class="tikihelp" title="{tr}Date selector : Apply a range of time between two dates{/tr}.">
                            {icon name="information"}
                        </a>
                    {else}
                        <a href="#" class="tikihelp" title="{tr}Only full word matches shown by default: Use wildcards (*) to get partial matches also. E.g. searching for 'foo' will miss foobar in the results, but 'foo*' will include it{/tr}.">
                            {icon name="information"}
                        </a>
                    {/if}
                {/if}
            </td>
            <td class="list_filter_input">
                {$field.renderedInput}
            </td>
        </tr>
        {/foreach}
        <tr>
            <td>&nbsp;</td>
            <td>
                <input class="button submit btn btn-primary" type="submit" name="filter" value="{tr}Filter{/tr}">
                <input class="button submit btn btn-primary" type="reset" name="reset_filter" value="{tr}Reset{/tr}">
            </td>
        </tr>
        </table>
    </form>
</div>

{jq}
$('#list_filter{{$filterCounter}} input[name=reset_filter]').off('click').on('click', function() {
    window.location.href = $(this).closest('form').attr('action').replace('#list_filter{{$filterCounter}}', '');
});
{/jq}