<div class="card">
    <div class="card-header">
        <h3 class="card-title">{$params.title}</h3>
    </div>
    <div class="card-body">
        <form id='{$params.id}'>
            {ticket}
            {$locked = $params.locked eq 'y'}
            <div class="table-responsive">
                   <table class="table table-bordered">
                    <tr class="conveneHeaderRow">
                        <td class="align-middle">
                            {if not $locked}
                                {if $canEdit}
                                    <input type="button" class="conveneAddDate btn btn-primary btn-sm" value="Add Date">
                                {/if}
                            {else}
                                {icon name='lock'}
                            {/if}
                            <div class="small text-muted">{$autolockMessage}</div>
                        </td>
                        {foreach $dates as $date => $votes}
                            <td class="align-bottom conveneHeader" data-date="{$date}">
                                <div class="tips" title="{$dateLabels[$date].gmdate}">{$dateLabels[$date].formatted}</div>
                                {if $canAdmin and not $locked}
                                    <button class="conveneDeleteDate icon btn btn-danger btn-sm" data-date="{$date}">
                                        {icon name='delete'}
                                    </button>
                                {/if}
                            </td>
                        {/foreach}
                    </tr>
                    {foreach $rows as $voter => $row}
                        {$editThisUser = ($canAdmin or ($canEdit and $user eq $voter)) and not $locked}
                        <tr class='conveneVotes conveneUserVotes' data-voter="{$voter}">
                            <td class='align-middle' style='white-space: nowrap'>
                                <div class='align-items-center d-flex justify-content-between'>
                                    {if $editThisUser}
                                        <div class='btn-group'>
                                            <button class='conveneUpdateUser icon btn btn-primary btn-sm'>
                                                {icon name='pencil' iclass='tips' ititle="{tr}Edit User/Save changes{/tr}"}
                                            </button>
                                            <button data-user='{$voter}' class='conveneDeleteUser icon btn btn-danger btn-sm'>
                                                {icon name='delete' iclass='tips' ititle="{tr}Remove User{/tr}"}
                                            </button>
                                        </div>
                                    {/if}
                                    <div class='flex-fill mx-2'>
                                        {$voter|userlink}
                                    </div>
                                    {if $params.avatars eq 'y'}
                                        <div>{$voter|avatarize}</div>
                                    {/if}
                                </div>
                            </td>
                            {foreach $row as $stamp => $vote}
                                {if $vote eq 1}
                                    {$class = 'convene-ok text-center alert-success'}
                                    {$icon = 'ok'}
                                {elseif $vote eq -1}
                                    {$class = 'convene-no text-center alert-danger'}
                                    {$icon = 'remove'}
                                {else}
                                    {$class = 'convene-unconfirmed text-center alert-light'}
                                    {$icon = 'help'}
                                {/if}
                                <td class='align-middle {$class}'>
                                    {icon name=$icon size=2}
                                    <input type='hidden' name='dates_{$stamp}_{$voter}' value='{$vote}' class='conveneUserVote' data-voter="{$voter}" data-date="{$stamp}">
                                </td>
                            {/foreach}
                        </tr>
                    {foreachelse}
                    <tr class='conveneVotes conveneUserVotes' data-voter="{$user}">
                        <td class='align-middle' style='white-space: nowrap'>
                            <div class='align-items-center d-flex justify-content-between'>
                                {if $canEdit}
                                    <div class='btn-group'>
                                        <button class='conveneUpdateUser icon btn btn-primary btn-sm'>
                                            {icon name='pencil' iclass='tips' ititle="{tr}Edit User/Save changes{/tr}"}
                                        </button>
                                        <button data-user='{$voter}' class='conveneDeleteUser icon btn btn-danger btn-sm'>
                                            {icon name='delete' iclass='tips' ititle="{tr}Remove User{/tr}"}
                                        </button>
                                    </div>
                                {/if}
                                <div class='flex-fill mx-2'>
                                    {$user|userlink}
                                </div>
                                {if $params.avatars eq 'y'}
                                    <div>{$user|avatarize}</div>
                                {/if}
                            </div>
                        </td>
                    {/foreach}
                    <tr class='conveneFooterRow'>
                        <td>
                            {if not $locked}
                                {if $canAdmin}
                                    <div class='btn-group'>
                                        <input class='conveneAddUser form-control' value='' placeholder='{tr}Username...{/tr}' style='float:left;width:72%;border-bottom-right-radius:0;border-top-right-radius:0;'>
                                        <input type='button' value='+' title='{tr}Add User{/tr}' class='conveneAddUserButton btn btn-primary' />
                                    </div>
                                {elseif $canEdit}
                                    <div class='btn-group'>
                                        <input class='conveneAddUser form-control' value='{$user}' disabled='disabled' style='float:left;width:72%;border-bottom-right-radius:0;border-top-right-radius:0;'>
                                        <input type='button' value='+' title='{tr}Add User{/tr}' class='conveneAddUserButton btn btn-primary' />
                                    </div>
                                {/if}
                            {/if}
                        </td>
                        {foreach $votes as $stamp => $total}
                            <td class='align-middle conveneFooter{if in_array($stamp, $topVoteStamps)} alert-success{/if}'>
                                <div class='align-items-center d-flex justify-content-center'>
                                    {$total}
                                    {if in_array($stamp, $topVoteStamps)}
                                        &nbsp
                                        {icon name='ok' iclass='alert-success tips' ititle=':{tr}Selected Date{/tr}'}
                                        {if $canAddEvents and count($topVoteStamps) eq 1 and $total gte $params.minvotes}
                                            <a class='btn btn-success btn-sm mx-1 text-white' href='tiki-calendar_edit_item.php?todate={$stamp}&calendarId={$params.calendarid}'>
                                                {icon name='calendar' iclass='tips' ititle=':{tr}Add as Calendar Event{/tr}'}
                                            </a>
                                        {/if}
                                    {/if}
                                </div>
                            </td>
                        {/foreach}
                    </tr>
                </table>
               </div>
        </form>
    </div>
</div>
