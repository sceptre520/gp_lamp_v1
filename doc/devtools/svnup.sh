#!/bin/sh
# (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
# 
# All Rights Reserved. See copyright.txt for details and a complete list of authors.
# Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
# $Id: svnup.sh 66119 2018-04-19 19:33:42Z luciash $

#
# Purpose: Update your Tiki instance to the latest version of SVN.
# This is useful to have a test/development site always up to date.
# You should not use this in a production environment.
#
# This script is intended to be ran on a cron job with the following command:
# sh doc/devtools/svnup.sh
#
# You should also put the following line on a cron (to update your database): 
# php console.php -n database:update
# 
# It's possible you may need to update your permissions with "sh setup.sh". 
# This is an interactive script so you need to set groups, etc to have in cron.
#
# If _htaccess is updated, you need to rename to .htaccess as well (or run sh htaccess.sh)
#
# To fully automate, you may also want to check the 
# Tiki Remote Instance Manage (TRIM), a combination 
# of shell and PHP scripts to install, update, backup, 
# restore and monitor (check security of) a large number 
# of Tiki installations (instances).
# http://doc.tiki.org/TRIM 
#
# TODO:
# Add option to run php installer/shell.php as well
# Make display of log an option

rm -f last.log
# memo 2018-02-07
# a little warning: running an svn update in trunk might result in a version
# of Tiki which requires a newer version of PHP than installed on the system.
# By running this script in a cronjob you might break your Tiki installation.
# There are some version checks in the (quick and dirty) script
# local/checkit.sh
# which compares PHP installed version with PHP required version.
#
# TODO Todo todo: merge local/checkit.sh with this script
#
svn update > last.log

# update composer and file perms
bash setup.sh -n fix

# update secdb
php doc/devtools/release.php --only-secdb --no-check-svn

# update the database
php console.php database:update

# uncomment the line below to see the list of all files updated. (ex.: if running manually)
# less last.log

exit 0
