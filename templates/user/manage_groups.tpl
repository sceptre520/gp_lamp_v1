{extends 'layout_view.tpl'}
{block name="title"}
    {title}{$title|escape}{/title}
{/block}
{block name="content"}
    {include file='access/include_items.tpl'}
    <form method="post" id="confirm-action" class="confirm-action" action="{service controller=$confirmController action=$confirmAction}">
        {include file='access/include_hidden.tpl'}
        <div class="form-group row mx-0">
            <label for="add_remove" class="col-form-label">
                {tr}Add to or remove from:{/tr}
            </label>
            <div class="radio col-sm-12">
                <label class="col-form-label mr-3">
                    <input type="radio" name="add_remove" id="add" value="add" checked="" class="mr-1">
                    {tr}Add to{/tr}
                </label>
                <label class="col-form-label">
                    <input type="radio" name="add_remove" id="remove" value="remove" class="mr-1">
                    {tr}Remove from{/tr}
                </label>
            </div>
        </div>
        <div class="form-group row mx-0">
            <label for="select_groups" class="col-form-label">
                {tr}These groups:{/tr}
            </label>
            <select name="checked_groups[]" multiple="multiple" size="{$countgrps}" class="form-control" id="select_groups" data-usergroups='{$userGroups}'>
                {section name=ix loop=$all_groups}
                    {if $all_groups[ix] != 'Anonymous' && $all_groups[ix] != 'Registered'}
                        <option value="{$all_groups[ix]|escape}">{$all_groups[ix]|escape}</option>
                    {/if}
                {/section}
            </select>
            {if $prefs.jquery_select2 !== 'y'}
                <div class="form-text">
                    {tr}Use Ctrl+Click or Command+Click to select multiple options{/tr}
                </div>
            {/if}
            {jq}
$("input[name=add_remove]").change(function () {
    var userGroups = $("#select_groups").data("usergroups"), mode = false;
    if ($(this).prop("checked") && userGroups) {
        if ($(this).val() === "add") {    // filter the group list to ones this user is not in
            mode = true;
        }
        $("option", "#select_groups").each(function () {
            if ($.inArray($(this).val(), userGroups) > -1) {
                $(this).prop("disabled", mode).css("opacity", mode ? .3 : 1);
            } else {
                $(this).prop("disabled", ! mode).css("opacity", ! mode ? .3 : 1);
            }
        });
        $("#select_groups").trigger("change.select2");
    }
}).change();
            {/jq}
        </div>
        <div class="form-group row mx-0" >
            <label for="default_group" class="col-form-label">
                {tr}Set default group:{/tr}
            </label>
            <select name="default_group" size="{$countgrps}" class="form-control" id="default_group">
                {foreach $all_groups as $group}
                    {if $group != 'Anonymous'}
                        <option value="{$group|escape}">{$group|escape}</option>
                    {/if}
                {/foreach}
            </select>
        </div>
        {include file='access/include_extra_fields.tpl'}
        {include file='access/include_submit.tpl'}
    </form>
{/block}
