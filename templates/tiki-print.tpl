{* $Id: tiki-print.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}<!DOCTYPE html>
<html lang="{if !empty($pageLang)}{$pageLang}{else}{$prefs.language}{/if}"{if !empty($page_id)} id="print_page_{$page_id}"{/if}>
    <head>
{include file='header.tpl'}
    </head>
    <body{html_body_attributes}>

        <div id="tiki-clean">
            <div id="tiki-mid">
{$mid_data}
            </div>
        </div>

{include file='footer.tpl'}
    </body>
</html>
