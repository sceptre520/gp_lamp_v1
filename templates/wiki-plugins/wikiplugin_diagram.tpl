{* $Id: wikiplugin_diagram.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{extends file="file_displays/diagram.tpl"}
{block name="diagram_extra"}
    {if $allow_edit}
        <div class="text-right">
            {if $file_id and $template ne $file_id }
                <a class="btn btn-link" target="_blank" href="tiki-editdiagram.php?fileId={$file_id}">{icon name="pencil"} Edit diagram</a>
            {else}
            <form id="edit-diagram-{$index}" target="_blank" action="tiki-editdiagram.php" method="post">
                    <input type="hidden" value="{$graph_data_base64}" name="xml">
                    <input type="hidden" value="{$sourcepage}" name="page">
                    <input type="hidden" value="{$template}" name="template">
                    <input type="hidden" value="{$gallery_id}" name="galleryId">
                    <input type="hidden" value="{$file_name}" name="fileName">
                    <input type="hidden" value="{$index}" name="index">
                    <input type="hidden" value="{if !$compressXml}false{else}true{/if}" name="compressXml">
                    <input type="hidden" value="{$compressXmlParam}" name="compressXmlParam">
                <a class="btn btn-link" href="javascript:void(0)" onclick="$('#edit-diagram-{$index}').submit()">{icon name="pencil"} Edit diagram</a>
            </form>
            {/if}
        </div>
    {/if}
{/block}