{if $data.relations}
    {if $data.display eq 'count'}
        {tr _0=$data.relations|count}%0 element(s){/tr}
    {else}
        <div id="display_f{$field.fieldId|escape}">
            {if $data.display eq 'toggle'}
                <a class="toggle" href="#display_f{$field.fieldId|escape}">{tr _0=$data.relations|count}%0 element(s){/tr}</a>
            {/if}
            <ul>
                {foreach from=$data.relations item=identifier}
                    <li>{object_link identifier=$identifier format=$data.format}</li>
                {/foreach}
            </ul>
        </div>
        {jq}
            $('#display_f{{$field.fieldId|escape}} ul').each(function () {
                var list = this;
                $(this).sortList();

                $(this).parent().find('.toggle').click(function () {
                    $(list).toggle();
                    return false;
                }).each(function () {
                    $(list).hide();
                });
            });
        {/jq}
    {/if}
{/if}
