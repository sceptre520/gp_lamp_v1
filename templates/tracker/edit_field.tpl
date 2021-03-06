{extends 'layout_view.tpl'}

{block name="title"}
    {title}{$title|escape}{/title}
{/block}

{block name="content"}
<form method="post" action="{service controller=tracker action=edit_field}">
    {accordion}
        {accordion_group title="{tr}General{/tr}"}
        <div class="form-group row mx-0">
            <label for="name" class="col-form-label">{tr}Name{/tr}</label>
            <input type="text" name="name" value="{$field.name|escape}" required="required" class="form-control">
        </div>
        <div class="form-group row mx-0">
            <label name="description" class="col-form-label">{tr}Description{/tr}</label>
            <textarea name="description" class="form-control">{$field.description|escape}</textarea>
        </div>
        <div class="form-check">
            <label>
                <input type="checkbox" class="form-check-input" name="description_parse" value="1"
                    {if $field.descriptionIsParsed eq 'y'}checked="checked"{/if}
                    >
                {tr}Description contains wiki syntax{/tr}
            </label>
        </div>
        {/accordion_group}
        {accordion_group title="{tr _0=$info.name}Options for %0{/tr}"}
            <p>{$info.description|escape}</p>

            {if ($prefs['feature_multilingual'] == 'y') && ($prefs['available_languages'])}
            {* If both conditions are not met the field won't accept input - it should be available only if multilingual is set*}
                {if $field.type eq 't' or $field.type eq 'a'}
                    {* Pretend the field attribute is just an option as it only exists for two field types *}
                    <div class="form-check">
                        <label>
                            <input type="checkbox" class="form-check-input" name="multilingual" value="1"
                                {if $field.isMultilingual eq 'y'}checked="checked"{/if}>
                            {tr}Multilingual{/tr}
                        </label>
                    </div>
                {/if}
            {/if}

            {foreach from=$info.params key=param item=def}
                <div class="form-group row mx-0">
                    <label for="option~{$param|escape}" class="col-form-label">{$def.name|escape}</label>
                    {if $def.options}
                        <select name="option~{$param|escape}" class="form-control">
                            {foreach from=$def.options key=val item=label}
                                <option value="{$val|escape}"
                                    {if $options[$param] eq $val} selected="selected"{/if}>
                                    {$label|escape}
                                </option>
                            {/foreach}
                        </select>
                    {elseif $def.selector_type}
                        {if $def.separator}
                            <div class="col-12">
                                {object_selector_multi type=$def.selector_type _separator=$def.separator _simplename="option~`$param`" _simplevalue=$options[$param] _simpleid="option-`$param`" _parent=$def.parent _parentkey=$def.parentkey _sort=$def.sort_order _format=$def.format _sort=$def.sort _filter=$def.searchfilter}
                            </div>
                        {else}
                            <div class="col-12">
                                {object_selector type=$def.selector_type _simplename="option~`$param`" _simplevalue=$options[$param] _simpleid="option-`$param`" _parent=$def.parent _parentkey=$def.parentkey _format=$def.format _sort=$def.sort _filter=$def.searchfilter}
                            </div>
                        {/if}
                    {elseif $def.separator}
                        <input type="text" name="option~{$param|escape}" value="{$options[$param]|implode:$def.separator|escape}" class="form-control">
                    {elseif $def.count eq '*'}
                        <input type="text" name="option~{$param|escape}" value="{$options[$param]|implode:','|escape}" class="form-control">
                    {elseif $def.type eq 'textarea'}
                        <textarea name="option~{$param|escape}" class="form-control">{$options[$param]|escape}</textarea>
                    {else}
                        <input type="text" name="option~{$param|escape}" value="{$options[$param]|escape}" class="form-control">
                    {/if}
                    <div class="form-text">{$def.description|escape}</div>
                    {if ! $def.selector_type}
                        {if $def.count eq '*'}
                            <div class="form-text">{tr}Separate multiple with commas.{/tr}</div>
                        {elseif $def.separator}
                            <div class="form-text">{tr}Separate multiple with &quot;{$def.separator}&quot;{/tr}</div>
                        {/if}
                    {/if}
                    {if $def.depends}
                    {jq}
                        $("input[name='option~{{$def.depends.field|escape}}'],textarea[name='option~{{$def.depends.field|escape}}'],select[name='option~{{$def.depends.field|escape}}']")
                        .change(function(){
                            var val = $(this).val();
                            var fg = $("input[name='option~{{$param|escape}}'],textarea[name='option~{{$param|escape}}'],select[name='option~{{$param|escape}}']").closest('.form-group');
                            if( val {{if $def.depends.op}}{{$def.depends.op}}{{else}}==={{/if}} {{$def.depends.value|json_encode}} || ( !{{$def.depends.value|json_encode}} && val ) ) {
                                fg.show();
                            } else {
                                fg.hide();
                            }
                        }).change();
                    {/jq}
                    {/if}
                </div>
            {/foreach}

        {/accordion_group}

        {accordion_group title="{tr}Validation{/tr}"}
            <div class="form-group row mx-0">
                <label for="validation_type" class="col-form-label">{tr}Type{/tr}</label>
                <select name="validation_type" class="form-control">
                    {foreach from=$validation_types key=type item=label}
                        <option value="{$type|escape}"
                            {if $type eq $field.validation} selected="selected"{/if}>
                            {$label|escape}
                        </option>
                    {/foreach}
                </select>
            </div>

            <div class="form-group row mx-0">
                <label for="validation_parameter" class="col-form-label">{tr}Parameters{/tr}</label>
                <input type="text" name="validation_parameter" value="{$field.validationParam|escape}" class="form-control">
            </div>

            <div class="form-group row mx-0">
                <label for="validation_message" class="col-form-label">{tr}Error Message{/tr}</label>
                <input type="text" name="validation_message" value="{$field.validationMessage|escape}" class="form-control">
            </div>
        {/accordion_group}

        {if $prefs.tracker_field_rules eq 'y'}
            {accordion_group title="{tr}Rules{/tr}"}
                {trackerrules rules=$field.rules|escape fieldId=$field.fieldId fieldType=$field.type targetFields=$fields}
            {/accordion_group}
        {/if}

        {accordion_group title="{tr}Permissions{/tr}"}
            <div class="form-group  mx-0">
                <label for="visibility" class="col-form-label">{tr}Visibility{/tr}</label>
                <select name="visibility" class="form-control">
                    <option value="n"{if $field.isHidden eq 'n'} selected="selected"{/if}>{tr}Visible by all{/tr}</option>
                    <option value="r"{if $field.isHidden eq 'r'} selected="selected"{/if}>{tr}Visible by all but not in RSS feeds{/tr}</option>
                    <option value="y"{if $field.isHidden eq 'y'} selected="selected"{/if}>{tr}Visible after creation by administrators only{/tr}</option>
                    <option value="p"{if $field.isHidden eq 'p'} selected="selected"{/if}>{tr}Editable by administrators only{/tr}</option>
                    <option value="a"{if $field.isHidden eq 'a'} selected="selected"{/if}>{tr}Editable after creation by administrators only{/tr}</option>
                    <option value="c"{if $field.isHidden eq 'c'} selected="selected"{/if}>{tr}Editable by administrators and creator only{/tr}</option>
                    <option value="i"{if $field.isHidden eq 'i'} selected="selected"{/if}>{tr}Immutable after creation{/tr}</option>
                </select>
                <div class="form-text">
                    {tr}Creator requires a user field with auto-assign to creator (1){/tr}
                </div>
            </div>

            <div class="form-group row mx-0">
                <label for="visible_by" class="groupselector col-form-label">{tr}Visible by{/tr}</label>
                <input type="text" name="visible_by" id="visible_by" value="{foreach from=$field.visibleBy item=group}{$group|escape}, {/foreach}" class="form-control">
                {autocomplete element='#visible_by' type='groupname' options="multiple:true,multipleSeparator:','"}{* note, multiple doesn't work in jquery-ui 1.8 *}
                <div class="form-text">
                    {tr}List of Group names with permission to see this field{/tr}. {tr}Separated by comma (,){/tr}
                </div>
            </div>

            <div class="form-group row mx-0">
                <label for="editable_by" class="groupselector col-form-label">{tr}Editable by{/tr}</label>
                <input type="text" name="editable_by" id="editable_by" value="{foreach from=$field.editableBy item=group}{$group|escape}, {/foreach}" class="form-control">
                {autocomplete element='#editable_by' type='groupname' options="multiple:true,multipleSeparator:','"}{* note, multiple doesn't work in jquery-ui 1.8 *}
                <div class="form-text">
                    {tr}List of Group names with permission to edit this field{/tr}. {tr}Separated by comma (,){/tr}
                </div>
            </div>

            <div class="form-group row mx-0">
                <label for="error_message" class="col-form-label">{tr}Error Message{/tr}</label>
                <input type="text" name="error_message" value="{$field.errorMsg|escape}" class="form-control">
            </div>
        {/accordion_group}

        {accordion_group title="{tr}Advanced{/tr}"}
            <div class="form-group row mx-0">
                <label for="permName" class="col-form-label">{tr}Permanent name{/tr}</label>
                <input type="text" name="permName" value="{$field.permName|escape}" pattern="[a-zA-Z0-9_]+" maxlength="{$permNameMaxAllowedSize}" class="form-control">
                <div class="form-text">
                    {tr}Changing the permanent name may have consequences in integrated systems.{/tr}
                </div>
            </div>
            {if $types}
                <div class="form-group row mx-0">
                    <label for="type" class="col-form-label">{tr}Field Type{/tr}</label>
                    <select name="type" data-original="{$field.type}" class="confirm-prompt form-control">
                        {foreach from=$types key=k item=info}
                            <option value="{$k|escape}"
                                {if $field.type eq $k}selected="selected"{/if}>
                                {$info.name|escape}
                                {if $info.deprecated}- Deprecated{/if}
                            </option>
                        {/foreach}
                    </select>
                    {foreach from=$types item=info key=k}
                        <div class="form-text field {$k|escape}">
                            {$info.description|escape}
                            {if $info.help}
                                <a href="{$prefs.helpurl|escape}{$info.help|escape:'url'}" target="tikihelp" class="tikihelp" title="{$info.name|escape}">
                                    {icon name='help'}
                                </a>
                            {/if}
                        </div>
                    {/foreach}
{jq}
$('select[name=type]').change(function () {
    var descriptions = $(this).closest('.form-group').
            find('.form-text.field').
            hide();

    if ($(this).val()) {
        descriptions
            .filter('.' + $(this).val())
            .show();
    }
}).change();
{/jq}
                    {if $prefs.tracker_change_field_type eq 'y'}
                        <div class="alert alert-danger">
                            {icon name="warning"} {tr}Changing the field type may cause irretrievable data loss - use with caution!{/tr}
                        </div>
                    {/if}
                    <div class="alert alert-info">
                        {icon name="information"} {tr}Make sure you rebuild the search index if you change field type.{/tr}
                    </div>
                </div>
            {/if}
            {if $prefs.feature_user_encryption eq 'y'}
                <div class="form-group row mx-0">
                    <label for="encryption_key_id" class="col-form-label">{tr}Encryption key{/tr}</label>
                    {help url="Encryption"}
                    <select name="encryption_key_id" data-original="{$field.encryptionKeyId}" class="confirm-prompt form-control">
                        <option value=""></option>
                        {foreach from=$encryption_keys item=key}
                            <option value="{$key.keyId|escape}"
                                {if $field.encryptionKeyId eq $key.keyId}selected="selected"{/if}>
                                {$key.name|escape}
                            </option>
                        {/foreach}
                    </select>
                    <div class="form-text">
                        {tr}Allow using shared encryption keys to store data entered in this field in encrypted format and decrypt upon request.{/tr}
                    </div>
                    <div class="alert alert-danger">
                        {icon name="warning"} {tr}Changing the encryption key will invalidate existing data.{/tr}
                    </div>
                </div>
            {/if}
        {/accordion_group}
    {/accordion}

    <div class="submit">
        <input type="submit" class="btn btn-primary" name="submit" value="{tr}Save{/tr}">
        <input type="hidden" name="trackerId" value="{$field.trackerId|escape}">
        <input type="hidden" name="fieldId" value="{$field.fieldId|escape}">
    </div>
</form>
{/block}
