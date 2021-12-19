#!/usr/bin/perl
# (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
# 
# All Rights Reserved. See copyright.txt for details and a complete list of authors.
# Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
# $Id: stripbraces.pl 66119 2018-04-19 19:33:42Z luciash $

    $/ = undef;
    $_ = <>;
    # // s#{([^{}]*)}|("(\\.|[^"\\])*"|'(\\.|[^'\\])*'|.[^/"'\\]*)#$2#gs;
    s#{([^{}]*)}##gs;
    print;
