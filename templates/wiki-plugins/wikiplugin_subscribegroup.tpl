{* $Id: wikiplugin_subscribegroup.tpl 66134 2018-04-21 11:33:19Z chibaguy $ *}
{strip}
<form method="post">
<input type="hidden" name="group" value="{$subscribeGroup|escape}">
<input type="hidden" name="iSubscribeGroup" value="{$iSubscribeGroup}">
{$text|escape}
<div><input type="submit" class="btn btn-primary btn-sm" name="subscribeGroup" value="{tr}{$action}{/tr}"></div>
</form>
{/strip}