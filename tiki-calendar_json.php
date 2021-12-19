<?php

/**
 * @package tikiwiki
 */

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-calendar_json.php 78605 2021-07-05 14:54:45Z rjsmelo $

$section = 'calendar';
require_once('tiki-setup.php');

$calendarlib = TikiLib::lib('calendar');
$categlib = TikiLib::lib('categ');
include_once('lib/newsletters/nllib.php');

$headerlib->add_cssfile('themes/base_files/feature_css/calendar.css', 20);
# perms are
#   $tiki_p_view_calendar
#   $tiki_p_admin_calendar
#   $tiki_p_change_events
#   $tiki_p_add_events
$access->check_feature('feature_calendar');

$maxSimultaneousWeekViewEvents = 3;

$myurl = 'tiki-calendar.php';
$exportUrl = 'tiki-calendar_export_ical.php';
$iCalAdvParamsUrl = 'tiki-calendar_params_ical.php';
$bufid = [];
$bufdata = [];
$editable = [];
if (! isset($cookietab)) {
    $cookietab = '1';
}
$rawcals = $calendarlib->list_calendars();
$cals_info = $rawcals;
$rawcals['data'] = Perms::filter([ 'type' => 'calendar' ], 'object', $rawcals['data'], [ 'object' => 'calendarId' ], 'view_calendar');
$viewOneCal = $tiki_p_view_calendar;
$modifTab = 0;

$minHourOfDay = 12;
$maxHourOfDay = 12;
$manyEvents = [];

foreach ($rawcals["data"] as $cal_data) {
    $cal_id = $cal_data['calendarId'];
    $minHourOfDay = min($minHourOfDay, (int)($cal_data['startday'] / 3600));
    $maxHourOfDay = max($maxHourOfDay, (int)(($cal_data['endday'] + 1) / 3600));
    if ($tiki_p_admin == 'y') {
        $cal_data["tiki_p_view_calendar"] = 'y';
        $cal_data["tiki_p_view_events"] = 'y';
        $cal_data["tiki_p_add_events"] = 'y';
        $cal_data["tiki_p_change_events"] = 'y';
    } elseif ($cal_data["personal"] == "y") {
        if ($user) {
            $cal_data["tiki_p_view_calendar"] = 'y';
            $cal_data["tiki_p_view_events"] = 'y';
            $cal_data["tiki_p_add_events"] = 'y';
            $cal_data["tiki_p_change_events"] = 'y';
        } else {
            $cal_data["tiki_p_view_calendar"] = 'n';
            $cal_data["tiki_p_view_events"] = 'y';
            $cal_data["tiki_p_add_events"] = 'n';
            $cal_data["tiki_p_change_events"] = 'n';
        }
    } else {
        $calperms = Perms::get([ 'type' => 'calendar', 'object' => $cal_id ]);
        $cal_data["tiki_p_view_calendar"] = $calperms->view_calendar ? 'y' : 'n';
        $cal_data["tiki_p_view_events"] = $calperms->view_events ? 'y' : 'n';
        $cal_data["tiki_p_add_events"] = $calperms->add_events ? 'y' : 'n';
        $cal_data["tiki_p_change_events"] = $calperms->change_events ? 'y' : 'n';
    }
    if ($cal_data["tiki_p_view_calendar"] == 'y') {
        $viewOneCal = 'y';
        $bufid[] = $cal_id;
        $bufdata["$cal_id"] = $cal_data;
    }
    if ($cal_data["tiki_p_view_events"] == 'y') {
        $visible[] = $cal_id;
    }
    if ($cal_data["tiki_p_add_events"] == 'y') {
        $modifTab = 1;
    }
    if ($cal_data["tiki_p_change_events"] == 'y') {
        $modifTab = 1;
        $editable[] = $cal_id;
        $visible[] = $cal_id;
    }
}

if ($viewOneCal != 'y') {
    $smarty->assign('errortype', 401);
    $smarty->assign('msg', tra("You do not have permission to view the calendar"));
    $smarty->display("error.tpl");
    die;
}

$listcals = $bufid;
$infocals["data"] = $bufdata;

$thiscal = [];
$checkedCals = [];

foreach ($listcals as $thatid) {
    if (is_array($_SESSION['CalendarViewGroups']) && (in_array("$thatid", $_SESSION['CalendarViewGroups']))) {
        $thiscal["$thatid"] = 1;
        $checkedCals[] = $thatid;
    } else {
        $thiscal["$thatid"] = 0;
    }
}

if (isset($_REQUEST['sort_mode'])) {
    $sort_mode = $_REQUEST['sort_mode'];
}

$viewstart = $_REQUEST['start'];
$viewend = $_REQUEST['end'];

$viewstart = new DateTime($viewstart);
$viewstart = $viewstart->getTimestamp();

$viewend = new DateTime($viewend);
$viewend = $viewend->getTimestamp();

if ($_SESSION['CalendarViewGroups']) {
    $listevents = $calendarlib->list_raw_items($_SESSION['CalendarViewGroups'], $user, $viewstart, $viewend, 0, -1);
    for ($i = count($listevents) - 1; $i >= 0; --$i) {
        $listevents[$i]['editable'] = in_array($listevents[$i]['calendarId'], $editable) ? "y" : "n";
        $listevents[$i]['visible'] = in_array($listevents[$i]['calendarId'], $visible) ? "y" : "n";
    }
} else {
    $listevents = [];
}


if ($prefs['feature_theme_control'] == 'y'  and isset($_REQUEST['calIds'])) {
    $cat_type = "calendar";
    $cat_objid = $_REQUEST['calIds'][0];
}

$parserLib = TikiLib::lib('parser');
$events = [];
foreach ($listevents as $event) {
    $eventPerms = Perms::get([
        'type' => 'calendaritem',
        'object' => $event['calitemId'],
        'parentId' => $event['calendarId'],
    ]);
    if ($eventPerms->change_events) {
        $url = 'tiki-calendar_edit_item.php?fullcalendar=y&calitemId=' . $event['calitemId'];
    } else {
        $url = 'tiki-calendar_edit_item.php?fullcalendar=y&viewcalitemId=' . $event['calitemId'];
    }
    $events[] = [
        'id'          => $event['calitemId'],
        'title'       => $event['name'],
        'extendedProps' => [
            'description' => ! empty($event["description"]) ? $parserLib->parse_data(
                $event["description"],
                ['is_html' => $prefs['calendar_description_is_html'] === 'y']
            ) : "",
        ],
        'url'         => $url,
        'allDay'      => $event['allday'] != 0,
        'start'       => TikiLib::date_format("c", $event['date_start'], false, 5, false),
        'end'         => TikiLib::date_format("c", $event['date_end'], false, 5, false),
        'editable'    => $event['editable'] === 'y',
        'color'       => '#' . $cals_info['data'][$event['calendarId']]['custombgcolor'],
        'textColor'   => '#' . $cals_info['data'][$event['calendarId']]['customfgcolor'],
    ];
}

echo json_encode($events);
