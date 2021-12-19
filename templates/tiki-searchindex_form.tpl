{* $Id: tiki-searchindex_form.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
<div class="mb-4 nohighlight">
    {if $prefs.feature_search_show_search_box eq 'y'}
        {filter action="tiki-searchindex.php" filter=$filter}{/filter}
    {/if}
</div><!--nohighlight-->
    {* do not change the comment above, since smarty 'highlight' outputfilter is hardcoded to find exactly this... instead you may experience white pages as results *}

{if isset($results)}
    {$results}
{/if}
