{* $Id: tiki-articles-js.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{jq notonready=true}
    var articleTypes = new Array();
{{foreach from=$types key=type item=properties}
    typeProp = new Array();
    {foreach from=$properties key=prop item=value}
        typeProp['{$prop|escape}'] = '{$value|escape}';
    {/foreach}
    articleTypes['{$type|escape}'] = typeProp;
{/foreach}}
{/jq}
