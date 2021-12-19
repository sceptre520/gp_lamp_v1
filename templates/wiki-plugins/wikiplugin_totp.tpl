<div id="totp_{$id}">
    <input hidden type="text" value="get_code" name="action">
    <div class="panel panel-primary">
        <div class="panel-heading"> <h3 class="panel-title">{$issuer}</h3> </div>
        <div class="panel-body"> Code: <strong class="code">--</strong> <span>Expires in: <span class="time">--</span> seconds.</span>
            {if $sourcePerm}<a class="twoFactorAuthShow" href="#">{tr}Show QRCode{/tr}</a>{/if}</div>
        {if $sourcePerm}
        <div class="col-md-12 card twoFactorAuthCard" style="display: none">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">{$tfaSecretQR}</div>
                    <div class="col-md-6 align-content-center">
                        <div class="d-flex align-items-center" style="height: 100%">
                            <ol>
                                <li>{tr}Install Google Authenticator® app on your device and open it{/tr}.</li>
                                <li>{tr}Tap “Scan a barcode”{/tr}.</li>
                                <li>{tr}Scan the QR code that is open in your browser{/tr}.</li>
                                <li>{tr}Done, Google Authenticator® is now generating codes{/tr}.</li>
                            </ol>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        {/if}
    </div>
</div>
{jq}

    $("#totp_{{$id}}").initTOTP();

{/jq}

