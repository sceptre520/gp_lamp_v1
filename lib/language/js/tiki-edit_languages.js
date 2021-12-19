//$Id: tiki-edit_languages.js 78613 2021-07-05 17:44:45Z robertokir $

$(document).ready(function() {
    $('form#select_action .translation_action').each(function() {
        $(this).change(function() {
            $('form#select_action').submit();
        });
    });
});
