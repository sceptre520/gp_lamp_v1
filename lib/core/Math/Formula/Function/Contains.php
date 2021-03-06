<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Contains.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Math_Formula_Function_Contains extends Math_Formula_Function
{
    public function evaluate($element)
    {
        $reference = $this->evaluateChild($element[0]);
        $pattern = $element[1];

        if (preg_match("|" . preg_quote($pattern) . "|", $reference)) {
            return true;
        }

        return false;
    }
}
