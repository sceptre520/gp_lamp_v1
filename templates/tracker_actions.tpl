{* $Id: tracker_actions.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{* navbar buttons at the top of the tracker pages *}
<div class="btn-group">

{if $tiki_p_admin_trackers eq 'y' and !empty($trackerId)}
    <a class="btn btn-info" href="{bootstrap_modal controller=tracker action=replace trackerId=$trackerId}">
        {icon name="settings"} {tr}Properties{/tr}
    </a>
    <a class="btn btn-info" href="{$trackerId|sefurl:'trackerfields'}">
        {icon name="th-list"} {tr}Fields{/tr}
    </a>
{/if}

{if $tiki_p_list_trackers eq 'y'}
    <a class="btn btn-info" href="{if $prefs.feature_sefurl eq 'y'}trackers{else}tiki-list_trackers.php{/if}">
        {icon name="trackers"} {tr}Trackers{/tr}
    </a>
{/if}

{if !empty($trackerId) and $tiki_p_view_trackers eq 'y' && (empty($showitems) || $showitems !== 'n')}
    <a class="btn btn-info" href="{$trackerId|sefurl:"tracker"}">
        {icon name="list"} {tr}Items{/tr}
    </a>
{/if}

</div>
