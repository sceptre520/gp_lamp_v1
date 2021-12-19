<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Comparator.php 78605 2021-07-05 14:54:45Z rjsmelo $

namespace Tiki\Recommendation;

class Comparator
{
    private $engines;

    public function __construct(EngineSet $engines)
    {
        $this->engines = $engines;
    }

    public function generate($input)
    {
        $out = [];

        $list = $this->engines->getBasicList();
        foreach ($list as $entry) {
            list($set, $engine) = $entry;
            $generated = $engine->generate($input);
            foreach ($generated as $recommendation) {
                $set->add($recommendation);
            }

            $out[] = $set;
        }

        return $out;
    }
}
