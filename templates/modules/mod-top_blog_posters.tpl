{* $Id: mod-top_blog_posters.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="top_blog_posters" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
{modules_list list=$modTopBloggers nonums=$nonums}
    {section name=ix loop=$modTopBloggers}
        <li>
                {$modTopBloggers[ix].user|userlink}
        </li>
    {/section}
{/modules_list}
{/tikimodule}
