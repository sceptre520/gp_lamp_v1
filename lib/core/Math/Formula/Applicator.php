<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Applicator.php 79125 2021-10-18 10:52:36Z kroky6 $

interface Math_Formula_Applicator
{
    public function add($another);
    public function sub($another);
    public function mul($another);
    public function div($another);
    public function floor();
    public function ceil();
    public function round($decimals);
    public function lessThan($another);
    public function moreThan($another);
    public function clone($number);
    public function isEmpty();
    public function equals($another);
}
