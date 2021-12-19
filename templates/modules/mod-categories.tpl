{* $Id: mod-categories.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="categories" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle error=$module_params.error}
    {if isset($tree)}
        {$tree}
    {/if}
{/tikimodule}
