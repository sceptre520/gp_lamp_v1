{* $Id: mod-last_created_blogs.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="last_created_blogs" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
    {modules_list list=$modLastCreatedBlogs nonums=$nonums}
        {section name=ix loop=$modLastCreatedBlogs}
            <li>
                <a class="linkmodule" href="tiki-view_blog.php?blogId={$modLastCreatedBlogs[ix].blogId}" title="{$modLastCreatedBlogs[ix].created|tiki_short_datetime:'':'n'}, {tr}by{/tr} {if $modLastCreatedBlogs[ix].user ne ''}{$modLastCreatedBlogs[ix].user|escape}{else}{tr}Anonymous{/tr}{/if}">
                    {$modLastCreatedBlogs[ix].title|escape}
                </a>
            </li>
        {/section}
    {/modules_list}
{/tikimodule}
