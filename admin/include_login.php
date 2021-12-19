<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: include_login.php 78699 2021-07-21 13:14:22Z jonnybradley $

// This script may only be included - so its better to die if called directly.
if (strpos($_SERVER['SCRIPT_NAME'], basename(__FILE__)) !== false) {
    header('location: index.php');
    exit;
}

if (empty($_REQUEST['registration_choices'])) {
    $_REQUEST['registration_choices'] = [];
}

if ($access->isActionPost() && $access->checkCsrf()) {
    $listgroups = $userlib->get_groups(0, -1, 'groupName_asc', '', '', 'n');
    $in = [];
    $out = [];
    foreach ($listgroups['data'] as $gr) {
        if ($gr['groupName'] == 'Anonymous') {
            continue;
        }
        if ($gr['registrationChoice'] == 'y' && ! in_array($gr['groupName'], $_REQUEST['registration_choices'])) {
            // deselect
            $out[] = $gr['groupName'];
        } elseif ($gr['registrationChoice'] != 'y' && in_array($gr['groupName'], $_REQUEST['registration_choices'])) {
            //select
            $in[] = $gr['groupName'];
        }
    }
    if (count($in)) {
        $userlib->set_registrationChoice($in, 'y');
    }
    if (count($out)) {
        $userlib->set_registrationChoice($out, null);
    }
    if ((count($in) || count($out))) {
        add_feedback('registration_choices', tra('registration choices'), 2);
    }
}
if (! empty($_REQUEST['refresh_email_group']) && $access->checkCsrf(true)) {
    $nb = $userlib->refresh_set_email_group();
    if ($nb > 0) {
        Feedback::success(tra(sprintf(tra("%d users were assigned to groups based on user emails matching the patterns defined for the groups."), $nb)));
    } else {
        Feedback::note(tra("No user emails matched the group pattern definitions, or the matching users were already assigned, or email patterns have not been set for any groups."));
    }
}
if (! empty($_REQUEST['resync_tracker']) && $access->checkCsrf(true)) {
    if (! empty($prefs["user_trackersync_trackers"])) {
        $nb = ['trackers' => 0, 'items' => 0];
        $utilities = new Services_Tracker_Utilities();
        $trackersync_trackers = unserialize($prefs["user_trackersync_trackers"]);
        foreach ($trackersync_trackers as $trackersync_id) {
            $nb['trackers']++;
            $items = TikiLib::lib('trk')->get_all_tracker_items($trackersync_id);
            foreach ($items as $itemId) {
                $nb['items']++;
                $utilities->resaveItem($itemId);
            }
        }
        Feedback::success(tr("%0 tracker(s) with %1 item(s) were synchronized.", $nb['trackers'], $nb['items']));
    }
}

$smarty->assign('gd_lib_found', function_exists('gd_info') ? 'y' : 'n');


if ($prefs['feature_antibot'] === 'y' && $prefs['captcha_questions_active'] !== 'y' && $prefs['recaptcha_enabled'] !== 'y') {
    // check Zend captcha will work
    $captcha = new Laminas\Captcha\Dumb();

    try {
        $captchaId = $captcha->getId(); // simple test for missing random generator
    } catch (Exception $e) {
        Feedback::error(tr('This method of captcha is not supported by your server, please select another or upgrade.')
            . ' ' . $e->getMessage());
    }
}

$listgroups = $userlib->get_groups(0, -1, 'groupName_asc', '', '', 'n');
$smarty->assign("listgroups", $listgroups['data']);

$blackL = TikiLib::lib('blacklist');

// set the default preference values
if ($prefs['pass_chr_num'] === 'y') {
    $charnum = 1;
}
if ($prefs['pass_chr_special'] === 'y') {
    $special = 1;
}
$length = $prefs['min_pass_length'];


if (isset($_POST['uploadIndex']) && $access->checkCsrf()) {
    if ($_FILES['passwordlist']['error'] === 4) {
        Feedback::error(tr('You need to select a file to upload.'));
    } elseif ($_FILES['passwordlist']['error']) {
        Feedback::error(tr('File Upload Error: %0', $_FILES['passwordlist']['error']));
    } else {  // if file has been uploaded, and there are no errors, then index the file in the database.
        $blackL->deletePassIndex();
        $blackL->createPassIndex();
        $blackL->loadPassIndex($_FILES['passwordlist']['tmp_name'], $_POST['loaddata']);
        Feedback::success(tra('Uploaded file has been populated into database and indexed. Ready to generate password lists.'));
    }
} elseif (isset($_POST['saveblacklist']) || isset($_POST['viewblacklist'])) {
    // if creating a blacklist, use selected values instead of defaults
    $charnum = 0;
    $special = 0;
    $length = $_POST['length'];

    if (isset($_POST['charnum'])) {
        $charnum = 1;
    }
    if (isset($_POST['special'])) {
        $special = 1;
    }
    $blackL->limit = $_POST['limit'];

    if (isset($_POST['viewblacklist'])) {  // if viewing the password list, enter plain text mode, spit out passwords, then exit.
        header('Content-type: text/plain');
        $blackL->generatePassList(false);
        exit;
    }
    // else if save blacklist chosen
    if ($blackL->generatePassList(true) && $access->checkCsrf()) {
        $filename = dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $blackL->generateBlacklistName();
        $blackL->set_preference('pass_blacklist_file', $blackL->generateBlacklistName(false));
        $blackL->loadBlacklist($filename);
    } else {
        Feedback::error(tr('Unable to Write Password File to Disk'));
    }
} elseif (isset($_POST['deleteIndex']) && $access->checkCsrf(true)) {
    $blackL->deletePassIndex();
}


$smarty->assign('file_using', $blackL->whatFileUsing());
$smarty->assign('length', $length);
$smarty->assign('charnum', $charnum);
$smarty->assign('special', $special);
$smarty->assign('limit', $blackL->limit);

$smarty->assign('num_indexed', $blackL->passIndexNum());

$smarty->assign('ldap_extension_loaded', extension_loaded('ldap'));
