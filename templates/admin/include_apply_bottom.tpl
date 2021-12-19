{* $Id: include_apply_bottom.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{if empty($applyTitle)}
    {$applyTitle="{tr}Apply changes{/tr}"}
{/if}
{if empty($applyValue)}
    {$applyValue="{tr}Apply{/tr}"}
{/if}
<br>
<div class="row">
    <div class="form-group col-lg-12 clearfix">
        <div class="text-center">
            <input
                type="submit"
                {if !empty($applyForm)}form="{$applyForm|escape:'attr'}"{/if}
                class="btn btn-primary tips"
                title=":{$applyTitle|escape:'attr'}"
                value="{$applyValue|escape:'attr'}"
            >
        </div>
    </div>
</div>
