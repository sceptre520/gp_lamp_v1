<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: InMemoryTracker.php 78605 2021-07-05 14:54:45Z rjsmelo $

namespace Tiki\Wiki\SlugManager;

class InMemoryTracker
{
    private $slugs = [];

    public function add($slug)
    {
        $this->slugs[$slug] = true;
    }

    public function __invoke($slug)
    {
        return isset($this->slugs[$slug]);
    }
}
