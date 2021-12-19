{* $Id: mod-num_submissions.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="num_submissions" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
    {tr}We have{/tr} {$modNumSubmissions} <a class="linkmodule" href="tiki-list_submissions.php">{tr}submissions waiting to be examined{/tr}</a>.
{/tikimodule}

