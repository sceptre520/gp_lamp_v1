{* $Id: confirm_newsletter_subscription.tpl 69162 2019-02-19 00:23:59Z lindonb $ *}{tr}Someone tried to subscribe this email address at our {$prefs.mail_template_custom_text}site:{/tr} {$server_name}
{tr}To the newsletter:{/tr} {$info.name}

{tr}Description:{/tr}
{$info.description}

{tr}Please access the following URL to confirm your subscription:{/tr}

{$mail_machine}tiki-newsletters.php?confirm_subscription={$code}
