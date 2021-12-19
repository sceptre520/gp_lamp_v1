<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: StoreInterface.php 78605 2021-07-05 14:54:45Z rjsmelo $

namespace Tiki\Recommendation\Store;

use Tiki\Recommendation\Recommendation;
use Tiki\Recommendation\RecommendationSet;

interface StoreInterface
{
    public function isReceived($input, Recommendation $recommendation);

    public function store($input, RecommendationSet $recommendation);

    public function getInputs();

    public function terminate();
}
