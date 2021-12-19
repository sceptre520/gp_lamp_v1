{* $Id: tiki-mailin.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{title}{tr}Mail-in feature{/tr}{/title}
{if !empty($content)}
    {$content}
{/if}
{if $tiki_p_admin_mailin}
    <p>{tr}Click here to go to mailin admin.{/tr} {icon name="next" href="tiki-admin_mailin.php"}</p>
{/if}
