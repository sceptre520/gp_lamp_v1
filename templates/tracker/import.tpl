{extends 'layout_view.tpl'}

{block name="title"}
    {title}{$title|escape}{/title}
{/block}

{block name="content"}
    {if !$success}
        <form class="form" method="post" action="{service controller=tracker action=import}" role=form">
            <div class="form-group row mx-0">
                <label class="col-form-label">{tr}Raw data{/tr}</label>
                <textarea name="raw" rows="20" class="form-control" required="required"></textarea>
            </div>
            <div class="form-group row mx-0">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="preserve" value="1">
                        {tr}Preserve tracker ID{/tr}
                    </label>
                </div>
            </div>
            {remarksbox close="y" title="{tr}Note{/tr}"}{tr}Use "Tracker -> Export -> Structure" to produce this data.{/tr}{/remarksbox}
            <div class="submit text-center">
                <input type="hidden" name="confirm" value="1">
                {if !$modal}
                    <a href="tiki-list_trackers.php" class="btn btn-link">{tr}Cancel{/tr}</a>
                {/if}
                <button type="submit" class="btn btn-primary">{tr}Import{/tr}</button>
            </div>
        </form>
    {else}
        {remarksbox type="confirm" close="n" title="{tr}Success{/tr}"}{tr}Tracker import completed.{/tr}{/remarksbox}
        <div class="submit text-center">
            <a href="tiki-list_trackers.php?find={$name|escape:'url'}" class="btn btn-primary">{tr}Return to Trackers{/tr}</a>
            <a href="{$trackerId|sefurl:'trackerfields'}" class="btn btn-primary">{tr}Import fields for this tracker{/tr}</a>
        </div>
    {/if}
{/block}
