{* $Id: wiki_edit.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

<div class='edit-zone clearfix'> {* grid class col-md-9 was added here for correct layout in form-horizontal tracker plugin but nested col-md-9s resulted; testing. *}
    {if $textarea__toolbars ne 'n'}
        <div class='textarea-toolbar nav-justified' id='{$textarea_id|default:editwiki}_toolbar'>
            {toolbars area_id=$textarea_id|default:editwiki comments=$comments switcheditor=$switcheditor section=$toolbar_section}
        </div>
    {/if}
    <textarea {$textarea_attributes}>{$textareadata|escape}</textarea>
</div>

{if isset($diff_style) and $diff_style}
    <input type="hidden" name="oldver" value="{$diff_oldver|escape}">
    <input type="hidden" name="newver" value="{$diff_newver|escape}">
    <input type="hidden" name="source_page" value="{$source_page|escape}">
{/if}

