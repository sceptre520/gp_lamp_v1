{* $Id: mod-old_articles.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="old_articles" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
{modules_list list=$modOldArticles nonums=$nonums}
    {section name=ix loop=$modOldArticles}
        <li>
            <a class="linkmodule" href="tiki-read_article.php?articleId={$modOldArticles[ix].articleId}">
                {$modOldArticles[ix].title|escape}
            </a>
        </li>
    {/section}
{/modules_list}
{/tikimodule}
