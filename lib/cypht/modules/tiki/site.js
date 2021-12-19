var tiki_groupmail_content = function(id, folder) {
    Hm_Ajax.request(
        [{'name': 'hm_ajax_hook', 'value': 'ajax_tiki_groupmail'},
        {'name': 'folder', 'value': folder},
        {'name': 'imap_server_ids', 'value': id}],
        function(res) {
            var ids = res.imap_server_ids.split(',');
            if (folder) {
                var i;
                for (i=0;i<ids.length;i++) {
                    ids[i] = ids[i]+'_'+Hm_Utils.clean_selector(folder);
                }
            }
            if (res.auto_sent_folder) {
                add_auto_folder(res.auto_sent_folder);
            }
            Hm_Message_List.update(ids, res.formatted_message_list, 'imap');
        },
        [],
        false,
        function() { Hm_Message_List.set_message_list_state('formatted_tiki_groupmail'); }
    );
    return false;
};

var tiki_groupmail_take = function(btn, id) {
    var detail = Hm_Utils.parse_folder_path(id);
    $(btn).text(tr('Taking')+'...');
    Hm_Ajax.request(
        [{'name': 'hm_ajax_hook', 'value': 'ajax_take_groupmail'},
        {'name': 'msgid', 'value': id},
        {'name': 'imap_msg_uid', 'value': detail.uid},
        {'name': 'imap_server_id', 'value': detail.server_id},
        {'name': 'folder', 'value': detail.folder}],
        function(res) {
            if (res.operator) {
                $(btn).text(res.operator);
            } else {
                $(btn).text(tr('TAKE'));
            }
            tiki_groupmail_content(detail.server_id, detail.folder);
        },
        [],
        false
    );
}

var tiki_groupmail_put_back = function(btn, id) {
    var detail = Hm_Utils.parse_folder_path(id);
    $(btn).text(tr('Putting back')+'...');
    Hm_Ajax.request(
        [{'name': 'hm_ajax_hook', 'value': 'ajax_put_back_groupmail'},
        {'name': 'msgid', 'value': id},
        {'name': 'imap_msg_uid', 'value': detail.uid},
        {'name': 'imap_server_id', 'value': detail.server_id},
        {'name': 'folder', 'value': detail.folder}],
        function(res) {
            if (res.item_removed) {
                $(btn).text(tr('TAKE'));
            }
            tiki_groupmail_content(detail.server_id, detail.folder);
        },
        [],
        false
    );
}

var tiki_event_rsvp_actions = function() {
    $(document).on("click", '.event_rsvp_link', function(e) {
        var uid = hm_msg_uid();
        var detail = Hm_Utils.parse_folder_path(hm_list_path(), 'imap');
        var $btn = $(this);
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_rsvp_action'},
            {'name': 'rsvp_action', 'value': $btn.data('action')},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'imap_server_id', 'value': detail.server_id},
            {'name': 'folder', 'value': detail.folder}],
            function(res) {
                $.each($('span.event_rsvp_link'), function(i,el) {
                    tiki_event_rsvp_button(el);
                });
                tiki_event_rsvp_button($btn[0]);
            },
            [],
            false
        );
    });
    $(document).on("change", 'select.event_calendar_select', function(e) {
        var uid = hm_msg_uid();
        var detail = Hm_Utils.parse_folder_path(hm_list_path(), 'imap');
        var $btn = $(this);
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_add_to_calendar'},
            {'name': 'calendar_id', 'value': $(this).val()},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'imap_server_id', 'value': detail.server_id},
            {'name': 'folder', 'value': detail.folder}],
            function(res) {
                // noop
            },
            [],
            false
        );
    });
    $(document).on("click", '.event_update_participant_status', function(e) {
        e.preventDefault();
        var uid = hm_msg_uid();
        var detail = Hm_Utils.parse_folder_path(hm_list_path(), 'imap');
        var $btn = $(this);
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_update_participant_status'},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'imap_server_id', 'value': detail.server_id},
            {'name': 'folder', 'value': detail.folder}],
            function(res) {
                // noop
            },
            [],
            false
        );
    });
    $(document).on("click", '.event_remove_from_calendar', function(e) {
        e.preventDefault();
        var uid = hm_msg_uid();
        var detail = Hm_Utils.parse_folder_path(hm_list_path(), 'imap');
        var $btn = $(this);
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_remove_from_calendar'},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'imap_server_id', 'value': detail.server_id},
            {'name': 'folder', 'value': detail.folder}],
            function(res) {
                // noop
            },
            [],
            false
        );
    });
}

var tiki_event_message_headers_actions = function(){
    $(document).on("click",'#print_pdf', function(e) {
        e.preventDefault();
        var uid = hm_msg_uid();
        var header_subject= $('.header_subject').text();
        var header_date= $('.header_date').text().replace('Date','').replace('<','').replace('>','');
        var header_from= $('.header_from').text().replace('From','').replace('<','').replace('>','');
        var header_to= $('.header_to').text().replace('To','').replace('<','').replace('>','');
        var msg_text= $('.msg_text_inner').html();

        non_ajax_submit('tiki-webmail.php?page=message&uid='+uid+'&list_path='+hm_list_path(), 'POST', [
            { name: 'page', value: 'message' },
            { name: 'uid', value: uid },
            { name: 'header_subject', value: header_subject },
            { name: 'header_date', value: header_date },
            { name: 'header_from', value: header_from },
            { name: 'header_to', value: header_to },
            { name: 'msg_text', value: msg_text },
            { name: 'display', value: 'pdf' },
        ]);
    });
}

var non_ajax_submit = function(action, method, values) {
    var form = $('<form/>', {
        action: action,
        method: method
    });
    $.each(values, function() {
        form.append($('<input/>', {
            type: 'hidden',
            name: this.name,
            value: this.value
        }));
    });
    form.appendTo('body').submit();
}

var tiki_event_rsvp_button = function(el) {
    var attrs = { };
    $.each(el.attributes, function(idx, attr) {
        attrs[attr.nodeName] = attr.nodeValue;
    });
    $(el).replaceWith(function () {
        var type = $(this).is('a') ? 'span' : 'a';
        return $("<"+type+">", attrs).append($(this).html());
    });
}

var tiki_mobilecheck = function () {
    (function (a) {
        (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
    })(navigator.userAgent || navigator.vendor || window.opera);
    return jQuery.browser.mobile;
};

var tiki_Hm_Ajax_Request = function() {
    var new_request = new Hm_Ajax_Request();
    new_request.fail = function(xhr, not_callable) {
        if (xhr.status && xhr.status == 500) {
            Hm_Notices.show(['ERRInternal Server Error - check server log file for details.']);
        } else if (not_callable === true) {
            Hm_Notices.show(['ERRCould not perform action - your session probably expired. Please reload page.']);
        } else {
            $('.offline').show();
        }
        Hm_Ajax.err_condition = true;
        this.run_on_failure();
    };
    new_request.format_xhr_data = function(data) {
        var res = []
        for (var i in data) {
            res.push(encodeURIComponent(data[i]['name']) + '=' + encodeURIComponent(data[i]['value']));
        }
        if ($('#hm_session_prefix').length > 0) {
            res.push(encodeURIComponent('hm_session_prefix') + '=' + encodeURIComponent($('#hm_session_prefix').val()));
        }
        return res.join('&');
    };
    return new_request;
}

var tiki_enable_oauth2_over_imap = function (){
    if ($('input.tiki_enable_oauth2_over_imap').is(':checked')){
        $(".oauth").addClass("reveal-if-checked");
        $(".oauth").removeClass("reveal-if-unchecked");
    }else {
        $(".oauth").addClass("reveal-if-unchecked");
        $(".oauth").removeClass("reveal-if-checked");
    }
    $(document).on("click", ".tiki_enable_oauth2_over_imap",function(){
        if( $(this).is(':checked') ){
            $(".oauth").addClass("reveal-if-checked");
            $(".oauth").removeClass("reveal-if-unchecked");
        }else {
            $(".oauth").addClass("reveal-if-unchecked");
            $(".oauth").removeClass("reveal-if-checked");
        } 
    });
}

var tiki_setup_move_to_trackers = function() {
    $(document).on('click', '.close_move_to_trackers', function(e) {
        e.preventDefault();
        $('.move_to_trackers:visible').hide();
    });
    $(document).on('click', '#move_to_trackers', function(e) {
        e.preventDefault();
        $(this).parent().find('.move_to_trackers').show();
    });
    $(document).on('click', '.tiki_folder_trigger', function(e) {
        e.preventDefault();
        $(this).next().toggle();
    });
    $(document).on('click', '.move_to_trackers a.object_selector_trigger', function(e) {
        e.preventDefault();
        var $el = $(this);
        $el.parent().find('.object-selector').remove();
        var url = $.service('search', 'object_selector', {
            params: {
                _name: 'move_to_trackers',
                object_type: 'trackeritem',
                tracker_id: $el.data('tracker')
            }
        });
        $.ajax({
            url: url,
            dataType: 'json',
            success: function (data) {
                $el.after(data.selector);
                $el.parent()
                    .find('.object-selector input[name=move_to_trackers]')
                    .object_selector()
                    .on('change', function() {
                        Hm_Ajax.request(
                            [{'name': 'hm_ajax_hook', 'value': 'ajax_move_to_tracker'},
                            {'name': 'tracker_field_id', 'value': $el.data('field')},
                            {'name': 'tracker_item_id', 'value': $(this).val().replace('trackeritem:', '')},
                            {'name': 'imap_msg_uid', 'value': hm_msg_uid()},
                            {'name': 'list_path', 'value': hm_list_path()},
                            {'name': 'folder', 'value': $el.data('folder')}],
                            function(res) {
                                if (res.tiki_redirect_url) {
                                    window.location.href = res.tiki_redirect_url;
                                }
                            },
                            [],
                            false
                        );
                    });
            }
        });
    });
}

var tiki_get_message_content = function(msg_part, uid, images) {
    if (!images) {
        images = 0;
    }
    if (!uid) {
        uid = $('.msg_uid').val();
    }
    if (uid) {
        if (hm_page_name() == 'message') {
            window.scrollTo(0,0);
        }
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_tiki_message_content'},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'imap_msg_part', 'value': msg_part},
            {'name': 'imap_allow_images', 'value': images},
            {'name': 'list_path', 'value': hm_list_path()}],
            function(res) {
                $('.msg_text').html('');
                $('.msg_text').append(res.msg_headers);
                $('.msg_text').append(res.msg_text);
                $('.msg_text').append(res.msg_parts);
                document.title = $('.header_subject th').text();
                imap_message_view_finished();
                tiki_message_view_finished(res.show_archive);
                tiki_prev_next_links(res.msg_prev_link, res.msg_prev_subject, res.msg_next_link, res.msg_next_subject);
            },
            [],
            false
        );
    }
    return false;
};

var tiki_message_view_finished = function(show_archive) {
    $('.msg_part_link').off("click").on("click", function() {
        $('.header_subject')[0].scrollIntoView();
        $('.msg_text_inner').css('visibility', 'hidden');
        return tiki_get_message_content($(this).data('messagePart'), false, $(this).data('allowImages'));
    });
    $('#flag_msg').off('click').on("click", function() { return tiki_flag_message(); });
    $('#unflag_msg').off('click').on("click", function() { return tiki_flag_message(); });
    $('#delete_message').off("click").on("click", function() { return tiki_delete_message(); });
    $('#move_message').off("click").on("click", function(e) { return tiki_move_copy(e, 'move', 'message');});
    $('#copy_message').off("click").on("click", function(e) { return tiki_move_copy(e, 'copy', 'message');});
    if (typeof show_archive !== 'undefined' && show_archive) {
        $('#archive_message').off("click").on("click", function() { return tiki_archive_message(); });
    } else {
        $('#archive_message').remove();
    }
    $('#unread_message').off('click').on("click", function() { return tiki_unread_message();});
    $('#delete_message').parent().contents().filter(function() { return this.nodeType == 3 && this.previousSibling.nodeType == 3; }).remove();
};

var tiki_prev_next_links = function(prev_link, prev_subject, next_link, next_subject) {
    var target = $('.msg_headers tr').last();
    if (prev_link) {
        var plink = '<a class="plink" href="'+prev_link+'"><div class="prevnext prev_img"></div> '+prev_subject+'</a>';
        $('<tr class="prev"><th colspan="2">'+plink+'</th></tr>').insertBefore(target);
    }
    if (next_link) {
        var nlink = '<a class="nlink" href="'+next_link+'"><div class="prevnext next_img"></div> '+next_subject+'</a>';
        $('<tr class="next"><th colspan="2">'+nlink+'</th></tr>').insertBefore(target);
    }
}

var tiki_delete_message = function() {
    if (!hm_delete_prompt()) {
        return false;
    }
    var uid = hm_msg_uid();
    var list_path = hm_list_path();
    if (list_path && uid) {
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_tiki_delete_message'},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'list_path', 'value': list_path}],
            function(res) {
                if (!res.delete_error) {
                    if (Hm_Utils.get_from_global('msg_uid', false)) {
                        return;
                    }
                    var nlink = $('.nlink');
                    if (nlink.length) {
                        window.location.href = nlink.attr('href');
                    }
                    else {
                        window.location.href = "?page=message_list&list_path="+hm_list_path();
                    }
                }
            }
        );
    }
    return false;
};

var tiki_archive_message = function() {
    var uid = hm_msg_uid();
    var list_path = hm_list_path();
    if (list_path && uid) {
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_tiki_archive_message'},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'list_path', 'value': list_path}],
            function(res) {
                if (!res.archive_error) {
                    if (Hm_Utils.get_from_global('msg_uid', false)) {
                        return;
                    }
                    var nlink = $('.nlink');
                    if (nlink.length) {
                        window.location.href = nlink.attr('href');
                    }
                    else {
                        window.location.href = "?page=message_list&list_path="+hm_list_path();
                    }
                }
            }
        );
    }
    return false;
};

var tiki_flag_message = function() {
    var uid = hm_msg_uid();
    var list_path = hm_list_path();
    if (list_path && uid) {
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_tiki_flag_message'},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'list_path', 'value': list_path}],
            function(res) {
                if (res.flag_state == 'flagged') {
                    $('#flag_msg').hide();
                    $('#unflag_msg').show();
                }
                else {
                    $('#flag_msg').show();
                    $('#unflag_msg').hide();
                }
                tiki_message_view_finished(res.show_archive);
            }
        );
    }
    return false;
};

var tiki_unread_message = function() {
    var uid = hm_msg_uid();
    var list_path = hm_list_path();
    if (list_path && uid) {
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_tiki_message_action'},
            {'name': 'action_type', 'value': 'unread'},
            {'name': 'imap_msg_uid', 'value': uid},
            {'name': 'list_path', 'value': list_path}],
            function() {
                window.location.href = "?page=message_list&list_path="+hm_list_path();
            }
        );
    }
    return false;
}

var tiki_move_copy = function(e, action, context) {
    imap_move_copy(e, action, context);
    var move_to = $('.msg_text .move_to_location');
    $('a', move_to).not('.imap_move_folder_link').not('.close_move_to').off("click").on("click", function(e) {
        e.preventDefault();
        tiki_perform_move_copy($(this).data('id'), move_to);
        return false;
    });
    return false;
}

var expand_tiki_move_to_mailbox = function() {
    var move_to = $('.move_to_location');
    $('a', move_to).not('.imap_move_folder_link').not('.close_move_to').off('click').on("click", function(e) {
        e.preventDefault();
        tiki_perform_move_copy($(this).data('id'), move_to);
        return false;
    });
}

var tiki_perform_move_copy = function(dest_id, move_to) {
    var action = $('.move_to_type').val();
    var ids = [hm_list_path()+'#'+hm_msg_uid()];
    move_to.html('').hide();
    if (ids.length > 0 && dest_id) {
        Hm_Ajax.request(
            [{'name': 'hm_ajax_hook', 'value': 'ajax_tiki_move_copy_action'},
            {'name': 'imap_move_ids', 'value': ids.join(',')},
            {'name': 'imap_move_to', 'value': dest_id},
            {'name': 'imap_move_action', 'value': action}],
            function(res) {
                if (action == 'move') {
                    var nlink = $('.nlink');
                    if (nlink.length) {
                        window.location.href = nlink.attr('href');
                    }
                    else {
                        window.location.href = "?page=message_list&list_path="+hm_list_path();
                    }
                }
            }
        );
    }
}

var tiki_send_archive = function() {
    $('.compose_post_archive').val(0).before('<input type="hidden" name="tiki_archive_replied" value="1">');
    $('.smtp_send').click();
}

var upload_file = function(file) {
    var res = '';
    var form = new FormData();
    var xhr = new XMLHttpRequest;
    Hm_Ajax.show_loading_icon();
    form.append('upload_file', file);
    form.append('hm_ajax_hook', 'ajax_smtp_attach_file');
    form.append('hm_page_key', $('#hm_page_key').val());
    form.append('draft_id', $('.compose_draft_id').val());
    if ($('#hm_session_prefix').length > 0) {
        form.append('hm_session_prefix', $('#hm_session_prefix').val());
    }
    xhr.open('POST', '', true);
    xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4){
            if (hm_encrypt_ajax_requests()) {
                res = Hm_Utils.json_decode(xhr.responseText);
                res = Hm_Utils.json_decode(Hm_Crypt.decrypt(res.payload));
            }
            else {
                res = Hm_Utils.json_decode(xhr.responseText);
            }
            if (res.file_details) {
                $('.uploaded_files').append(res.file_details);
                $('.delete_attachment').on("click", function() { return delete_attachment($(this).data('id'), this); });
            }
            Hm_Ajax.stop_loading_icon();
            if (res.router_user_msgs && !$.isEmptyObject(res.router_user_msgs)) {
                Hm_Notices.show(res.router_user_msgs);
            }
        }
    }
    xhr.send(form);
};

/* executes on onload, has access to other module code */
$(function() {
    if (hm_page_name() == 'groupmail') {
        Hm_Message_List.select_combined_view();
        $('.content_cell').swipeDown(function(e) { e.preventDefault(); Hm_Message_List.load_sources(); });
        $('.source_link').click(function() { $('.list_sources').toggle(); return false; });
    }

    if (hm_page_name() == 'message') {
        tiki_event_rsvp_actions();
        tiki_event_message_headers_actions();
        tiki_setup_move_to_trackers();
    }

    if (hm_page_name() === 'message' && hm_list_path().substr(0, 14) === 'tracker_folder') {
        tiki_get_message_content();
        Hm_Ajax.add_callback_hook('ajax_imap_folder_expand', expand_tiki_move_to_mailbox);
    }

    if (hm_page_name() == 'settings') {
        tiki_enable_oauth2_over_imap();
    }

    if (hm_page_name() == 'compose' && hm_list_path().substr(0, 14) === 'tracker_folder') {
        if (!hm_msg_uid()) {
            $('.smtp_send_archive').remove();
        } else {
            $('.smtp_send_archive').off('click').on('click', function() { tiki_send_archive(); });
        }
    }

    if (tiki_mobilecheck()) {
        if (! $('body').hasClass('mobile')) $('body').addClass('mobile');
    }

    if (! $('body').hasClass('tiki-cypth')) $('body').addClass('tiki-cypht');
    $('.mobile .folder_cell').detach().appendTo('body');

    $('.mobile .folder_toggle').click(function(){
        $('.mobile .folder_cell').toggleClass('slide-in');
        if ($(this).attr('style') == '') $('.mobile .folder_list').hide();
    });

    $('.inline-cypht .select2-container').each(function () {
        $(this).prev().addClass('noselect2');
    });

    $('.folder_list').on('click', '.clear_cache', function(e) {
        e.preventDefault();
        sessionStorage.clear();
        window.location.href = window.location.href.replace(/#.*/, '') + ( window.location.href.indexOf('?') > -1 ? '&' : '?' ) + 'clear_cache=1';
        return false;
    });
});
