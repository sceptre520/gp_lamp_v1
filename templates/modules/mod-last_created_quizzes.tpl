{* $Id: mod-last_created_quizzes.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="last_created_quizzes" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
{modules_list list=$modLastCreatedQuizzes nonums=$nonums}
    {section name=ix loop=$modLastCreatedQuizzes}
        <li>
            <a class="linkmodule" href="tiki-take_quiz.php?quizId={$modLastCreatedQuizzes[ix].quizId}">
                {$modLastCreatedQuizzes[ix].name|escape}
            </a>
        </li>
    {/section}
{/modules_list}
{/tikimodule}
