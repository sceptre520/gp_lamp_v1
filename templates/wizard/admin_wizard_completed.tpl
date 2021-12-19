{* $Id: admin_wizard_completed.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}

<div class="media">
    <div class="mr-4">
        {icon name="check" size=2} {tr}Congratulations{/tr}. {tr}You are done with the admin wizard{/tr}.<br>
    </div>
    <div class="media-body">
        <fieldset>
            <legend>{tr}Next?{/tr}</legend>
            <ul>
                <li>{tr _0="tiki-wizard_admin.php?stepNr=0&url=tiki-index.php"}Choose another <a href="%0">Wizard</a> to continue configuring your site as admin{/tr}.</li>
                {if $prefs.feature_wizard_user eq 'y'}
                    <li>{tr _0="tiki-wizard_user.php"}Visit the <a href="%0">User Wizard</a> to set some of your user preferences as a user{/tr}.</li>
                {/if}
                <li>{tr}Or click at the button <strong>Finish</strong> to end the admin wizard and go back to the where you were{/tr}.</li>
            </ul>
        </fieldset>
    </div>
</div>
