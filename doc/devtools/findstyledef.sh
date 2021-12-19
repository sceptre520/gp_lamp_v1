#!/bin/bash
# (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
# 
# All Rights Reserved. See copyright.txt for details and a complete list of authors.
# Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
# $Id: findstyledef.sh 66119 2018-04-19 19:33:42Z luciash $

# finds all the style and class definitions in tpl and php files
#
# param needed for execution: rootdir of tiki
# 
# ohertel@tw.o

perl ./findstyles.pl $1 | sort | uniq > result.txt
