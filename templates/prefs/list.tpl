{* $Id: list.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
<div class="adminoptionbox preference form-group row clearfix {$p.tagstring|escape}{if isset($smarty.request.highlight) and $smarty.request.highlight eq $p.preference} highlight{/if}" style="text-align: left;">
    <label class="col-sm-4 col-form-label" for="{$p.id|escape}">{$p.name|escape|breakline}</label>
    <div class="col-sm-8">
        {if !empty($p.units)}
            <div class="input-group">
        {/if}
        <select
            class="form-control"
            name="{$p.preference|escape}"
            id="{$p.id|escape}"
            data-tiki-admin-child-block=".{$p.preference|escape}_childcontainer"
            data-tiki-admin-child-mode="{$mode|escape}"
        >
            {foreach from=$p.options key=value item=label}
                <option value="{$value|escape}"{if $value eq $p.value} selected="selected"{/if} {$p.params}>
                    {$label|escape}
                </option>
            {/foreach}
        </select>
        {if !empty($p.units)}
                <div class="input-group-append">
                    <span class="input-group-text">{$p.units}</span>
                </div>
            </div>
        {/if}
        {include file="prefs/shared.tpl"}
    </div>
</div>
