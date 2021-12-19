{* $Id: tiki-copypage.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{title}{tr}Copy page:{/tr} {$page}{/title}

<div class="t_navbar">
    {assign var=thispage value=$page|escape:url}
    {button href="tiki-index.php?page=$thispage" _text="{tr}View page{/tr}"}
</div>

<form action="tiki-copypage.php" method="post" class="form-horizontal">
    <input type="hidden" name="page" value="{$page|escape}">
    {if isset($page_badchars_display)}
        {if $prefs.wiki_badchar_prevent eq 'y'}
            <div class="form-group row">
                <div class="col-sm-10"><br>
                {remarksbox type=errors title="{tr}Invalid page name{/tr}"}
                    {tr _0=$page_badchars_display|escape}The page name specified contains unallowed characters. It will not be possible to save the page until those are removed: <strong>%0</strong>{/tr}
                {/remarksbox}
                </div>
            </div>
        {else}
            <div class="form-group row">
                <div class="col-sm-12">
                {remarksbox type=tip title="{tr}Tip{/tr}"}
                    {tr _0=$page_badchars_display|escape}The page name specified contains characters that may render the page hard to access. You may want to consider removing those: <strong>%0</strong>{/tr}
                {/remarksbox}
                </div>
            </div>
            <input type="hidden" name="badname" value="{$newname|escape}">
            <input type="submit" class="btn btn-primary btn-sm" name="confirm" value="{tr}Use this name anyway{/tr}">
        {/if}
    {elseif isset($msg)}
        {remarksbox type=errors}
            {$msg}
        {/remarksbox}
    {/if}

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{tr}New name{/tr}</label>
        <div class="col-sm-7">
            <input type='text' id='newpage' name='newpage' size='40' value='{$newname|escape}' class="form-control">
        </div>
    </div>

    {if $tiki_p_add_object eq 'y' and $prefs.feature_categories == 'y' }
        <div class="form-group row">
            <label class="col-sm-3 form-check-label" for="duplicate_categories">{tr}Duplicate categories{/tr}</label>
            <div class="col-sm-7">
                <div class="form-check">
                    <input type="checkbox" name="dupCateg" class="form-check-input" id="duplicate_categories" value="y" checked="checked">
                </div>
            </div>
        </div>
    {/if}

    {if $tiki_p_freetags_tag eq 'y' and $prefs.feature_freetags == 'y' }
        <div class="form-group row">
            <label class="col-sm-3 form-check-label" for="duplicate_freetags">{tr}Duplicate tags{/tr}</label>
            <div class="col-sm-7">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="dupTags" id="duplicate_freetags" value="y" checked="checked">
                </div>
            </div>
        </div>
    {/if}

    <div class="form-group row">
        <label class="col-sm-3 col-form-label"></label>
        <div class="col-sm-7">
            <input type="submit" class="btn btn-primary btn-sm" name="copy" value="{tr}Copy{/tr}">
        </div>
    </div>
</form>
