<?php

/**
 * @package tikiwiki
 */

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-batch_todo.php 78605 2021-07-05 14:54:45Z rjsmelo $

include('tiki-setup.php');
$todolib = TikiLib::lib('todo');

$access->check_feature('feature_trackers'); // TODO add more features as the lib does more

$todos = $todolib->listTodoObject();
foreach ($todos as $todo) {
    $todolib->applyTodo($todo);
}
