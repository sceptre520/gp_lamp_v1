{* $Id: mod-last_created_faqs.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="last_created_faqs" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
{modules_list list=$modLastCreatedFaqs nonums=$nonums}
    {section name=ix loop=$modLastCreatedFaqs}
        <li>
            <a class="linkmodule" href="tiki-view_faq.php?faqId={$modLastCreatedFaqs[ix].faqId}">
                {$modLastCreatedFaqs[ix].title|escape}
            </a>
        </li>
    {/section}
{/modules_list}
{/tikimodule}
