<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Equals.php 79125 2021-10-18 10:52:36Z kroky6 $

class Math_Formula_Function_Equals extends Math_Formula_Function
{
    public function evaluate($element)
    {
        // Multiple components will all need to be equal.

        $out = [];

        $reference = $this->evaluateChild($element[0]);

        foreach ($element as $child) {
            $component = $this->evaluateChild($child);
            if ($reference instanceof Math_Formula_Applicator) {
                if (! $reference->equals($component)) {
                    return false;
                }
            } elseif ($component instanceof Math_Formula_Applicator) {
                if (! $component->equals($reference)) {
                    return false;
                }
            } elseif ($component != $reference) {
                return false;
            }
        }

        return true;
    }
}
