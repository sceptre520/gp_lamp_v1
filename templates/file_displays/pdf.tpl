{* $Id: pdf.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{if $source_link}
    <div class="iframe-container">
        <iframe src="{$source_link}" /></iframe>
    </div>
    {if $export_pdf_link}
        <div class="mt-3">
            <a class="btn btn-primary" href="{$export_pdf_link}">{tr}Export PDF{/tr}</a>
        </div>
    {/if}
{/if}
