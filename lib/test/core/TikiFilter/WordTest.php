<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: WordTest.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * @group unit
 *
 */

class TikiFilter_WordTest extends TikiTestCase
{
    public function testFilter()
    {
        $filter = TikiFilter::get('word');

        $this->assertEquals('123ab_c', $filter->filter('-123 ab_c'));
    }
}
