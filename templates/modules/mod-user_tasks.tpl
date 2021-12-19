{* $Id: mod-user_tasks.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{if isset($modTasks)}
{if !isset($tpl_module_title)}{assign var=tpl_module_title value="<a href='tiki-user_tasks.php'>{tr}My Tasks{/tr}</a>"}{/if}
{tikimodule error=$module_params.error title=$tpl_module_title name="user_tasks" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
<div class="module">
<form action="{$ownurl}" method="post" id="modNewTaskForm">
<input style="font-size: 9px;" type="text" name="modTasksTitle" />
<input style="font-size: 9px;" type="submit" class="btn btn-primary btn-sm" name="modTasksSave" value="{tr}Add{/tr}" />
</form>
</div>
<form action="{$ownurl}" method="post">
{if $nonums != 'y'}<ol>{else}<ul>{/if}
{section name=ix loop=$modTasks}
    <li class="prio{$modTasks[ix].priority}">
    {if $modTasks[ix].creator ne $user}
        &gt;&gt;
    {else}
        <input type="checkbox" class="form-check-input" name="modTasks[{$modTasks[ix].taskId}]" />
    {/if}
    {$modTasks[ix].taskId|tasklink:linkmodule}{if isset($modTasks[ix].percentage)} ({$modTasks[ix].percentage}%){/if}
    </li>
{/section}
{if $nonums != 'y'}</ol>{else}</ul>{/if}
<input style="font-size: 9px;" type="submit" class="btn btn-primary btn-sm" name="modTasksCom" value="{tr}Done{/tr}" />
<input style="font-size: 9px;" type="submit" class="btn btn-primary btn-sm" name="modTasksDel" value="{tr}Del{/tr}" />
</form>
{/tikimodule}
{/if}
