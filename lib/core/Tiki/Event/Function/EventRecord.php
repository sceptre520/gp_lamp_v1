<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: EventRecord.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Tiki_Event_Function_EventRecord extends Math_Formula_Function
{
    private $recorder;

    public function __construct($recorder)
    {
        $this->recorder = $recorder;
    }

    public function evaluate($element)
    {
        $event = $this->evaluateChild($element[0]);
        $arguments = $this->evaluateChild($element[1]);

        $this->recorder->recordEvent($event, $arguments);

        return 1;
    }
}
