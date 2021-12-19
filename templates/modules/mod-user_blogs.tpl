{* $Id: mod-user_blogs.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{if isset($modUserBlogs)}
{tikimodule error=$module_params.error title=$tpl_module_title name="user_blogs" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
{modules_list list=$modUserBlogs nonums=$nonums}
    {section name=ix loop=$modUserBlogs}
        <li>
            <a class="linkmodule" href="tiki-view_blog.php?blogId={$modUserBlogs[ix].blogId}">
                {$modUserBlogs[ix].title|escape}
            </a>
        </li>
    {/section}
{/modules_list}
{/tikimodule}
{/if}
