{* $Id: include_apply_top.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{if empty($applyTitle)}
    {$applyTitle="{tr}Apply changes{/tr}"}
{/if}
{if empty($applyValue)}
    {$applyValue="{tr}Apply{/tr}"}
{/if}
<div class="float-right">
    <input
        type="submit"
        {if !empty($applyForm)}form="{$applyForm|escape:'attr'}"{/if}
        class="btn btn-primary tips"
        title=":{$applyTitle|escape:'attr'}"
        value="{$applyValue|escape:'attr'}"
    >
</div>
