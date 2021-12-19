{* $Id: mod-top_active_blogs.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="top_active_blogs" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
{modules_list list=$modTopActiveBlogs nonums=$nonums}
    {section name=ix loop=$modTopActiveBlogs}
        <li>
            <a class="linkmodule" href="tiki-view_blog.php?blogId={$modTopActiveBlogs[ix].blogId}">
                {$modTopActiveBlogs[ix].title|escape}
            </a>
        </li>
    {/section}
{/modules_list}
{/tikimodule}
