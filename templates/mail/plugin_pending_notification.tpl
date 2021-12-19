{assign var=object_link value={object_link type=$type id=$objectId}}
{tr _0=$plugin_name _1=$object_link}Plugin %0 is pending approval on %1.{/tr}

{tr _0="{$base_url}tiki-plugins.php"}See all the {$prefs.mail_template_custom_text}pending plugins in the <a href='%0'>plugin approval page</a>.{/tr}

{if !empty($arguments)}
    <b>{tr}Plugin arguments:{/tr}</b>
    {foreach $arguments as $key => $value}
        * {$key}: {$value}
    {/foreach}
{/if}

{if !empty($body)}
    <b>{tr}Plugin body:{/tr}</b>
    {$body|escape}
{/if}
