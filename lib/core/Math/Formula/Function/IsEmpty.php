<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: IsEmpty.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Math_Formula_Function_IsEmpty extends Math_Formula_Function
{
    public function evaluate($element)
    {
        foreach ($element as $child) {
            try {
                $component = $this->evaluateChild($child);
            } catch (Math_Formula_Exception $e) {
                // if the child value is not in the variables (i.e. index) catch exception and return IsEmpty = true
                return true;
            }
            if ($component instanceof Math_Formula_Applicator) {
                return $component->isEmpty();
            }
            if (! empty($component)) {
                return false;
            }
        }

        return true;
    }
}
