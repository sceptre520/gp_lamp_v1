{* $Id: mod-top_articles.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="top_articles" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
{modules_list list=$modTopArticles nonums=$nonums}
    {section name=ix loop=$modTopArticles}
        <li>
            <a class="linkmodule" href="{$modTopArticles[ix].articleId|sefurl:article}">
                {$modTopArticles[ix].title|escape}
            </a>
        </li>
    {/section}
{/modules_list}
{/tikimodule}
