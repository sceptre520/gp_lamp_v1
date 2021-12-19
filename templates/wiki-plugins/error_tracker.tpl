{* $Id: error_tracker.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{if $prefs.feature_trackers ne 'y'}
    <span class="alert-warning">{tr}This feature is disabled{/tr}</span>
{else}
    <span class="alert-warning">{tr}Missing or incorrect trackerId parameter for the plugin.{/tr}</span>
    {if $tiki_p_view_trackers eq 'y'}{button href="tiki-list_trackers.php" _text="{tr}List Trackers{/tr}"}{/if}
{/if}
