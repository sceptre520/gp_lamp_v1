{* $Id: tiki-searchindex.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{extends 'layout_view.tpl'}

{block name=title}
    {title help="Search" admpage="search"}{tr}Search{/tr}{/title}
{/block}

{block name=content}
{include file='tiki-searchindex_form.tpl'}
{/block}
