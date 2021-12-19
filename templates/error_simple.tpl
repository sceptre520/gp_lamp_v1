{* $Id: error_simple.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}<!DOCTYPE html>
<html lang="{if !empty($pageLang)}{$pageLang}{else}{$prefs.language}{/if}">
    <head>
        {include file='header.tpl'}
    </head>
    <body{html_body_attributes}>
        {if $prefs.feature_bidi eq 'y'}
            <table dir="rtl" ><tr><td>
        {/if}
        <div id="tiki-mid">
            <div class="card">
                <div class="card-header">{icon name='error' alt="{tr}Error{/tr}" style="vertical-align:middle"}{tr}Error{/tr}</div>
                <div class="card-body">
                    {$msg}
                    <a href="javascript:window.close()" class="linkmenu">{tr}Close Window{/tr}</a><br><br>
                </div>
            </div>
        </div>
        {if $prefs.feature_bidi eq 'y'}
            </td></tr></table>
        {/if}
        {include file='footer.tpl'}
    </body>
</html>
