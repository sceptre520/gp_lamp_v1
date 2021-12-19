<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: FactoryInterface.php 78605 2021-07-05 14:54:45Z rjsmelo $

namespace Tiki\MailIn\Action;

use Tiki\MailIn\Account;
use Tiki\MailIn\Source\Message;

interface FactoryInterface
{
    public function createAction(Account $account, Message $message);
}
