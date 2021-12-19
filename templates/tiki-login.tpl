{* $Id: tiki-login.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
<div class="row justify-content-center">
    <div class="col-sm-6">
        {module module=login_box
            mode="module"
            show_register="y"
            show_forgot="y"
            show_two_factor_auth="{$twoFactorForm}"
            error=""
            flip=""
            decorations=""
            nobox=""
            notitle=""
        }
    </div>
</div>
