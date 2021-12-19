{* $Id: ajax.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}<!DOCTYPE html>
{if ! $plain}
    {block name=title}{/block}
{/if}
{block name=content}{/block}
{if $headerlib}
    {$headerlib->output_js_config()}
    {$headerlib->output_js_files()}
    {$headerlib->output_js()}
{/if}
{if $prefs.feature_debug_console eq 'y' and not empty($smarty.request.show_smarty_debug)}
    {debug}
{/if}
