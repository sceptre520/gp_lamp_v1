<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ResultSet.php 78605 2021-07-05 14:54:45Z rjsmelo $

class Search_Elastic_ResultSet extends Search_ResultSet
{
    public function highlight($content)
    {
        if (isset($content['_highlight'])) {
            return strip_tags($content['_highlight'], '<em>');
        }
    }
}
