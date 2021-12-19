<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ArticleDeleted.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * Class for article_deleted events
 */
class Reports_Send_EmailBuilder_ArticleDeleted extends Reports_Send_EmailBuilder_Abstract
{
    public function getTitle()
    {
        return tr('Articles deleted:');
    }

    public function getOutput(array $change)
    {
        $base_url = $change['data']['base_url'];

        $output = '<u>' . $change['data']['user'] . '</u> ' . tra('removed the article') .
                            " <a href=\"{$base_url}tiki-read_article.php?articleId=" . $change['data']['articleId'] . "\">" . $change['data']['articleTitle'] . '</a>.';

        return $output;
    }
}