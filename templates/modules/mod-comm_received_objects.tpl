{* $Id: mod-comm_received_objects.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="comm_received_objects" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
    <div>
        <span class="module">{tr}Pages:{/tr}</span>
        <span class="module">&nbsp;{$modReceivedPages}</span>
    </div>
{/tikimodule}
