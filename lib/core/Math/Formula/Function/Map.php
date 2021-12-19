<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Map.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Math_Formula_Function_Map extends Math_Formula_Function
{
    public function evaluate($element)
    {
        $out = [];

        foreach ($element as $child) {
            $out[$child->getType()] = $this->evaluateChild($child[0]);
        }

        return $out;
    }
}
