{* $Id: mod-locator.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{tikimodule error=$module_error title=$tpl_module_title name="locator" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
    <div class="minimap map-container" data-marker-filter=".geolocated"{$center}></div>
{/tikimodule}
