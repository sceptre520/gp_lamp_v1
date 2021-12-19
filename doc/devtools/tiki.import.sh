#!/bin/bash
# (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
#
# All Rights Reserved. See copyright.txt for details and a complete list of authors.
# Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
# $Id: tiki.import.sh 66119 2018-04-19 19:33:42Z luciash $

# TODO: Handle local file gal and wiki_up
# TODO: update to using new Console commands

if [ -z "$TIKI_PATH" ]; then
echo -n Enter the Tiki absolute path:
read TIKI_PATH
fi

if [ -z "$TIKI_PATH" ] ; then
echo Path name can not be emtpy.
exit 1
fi

if [ -z "$TIKI_DBDUMP" ]; then
echo -n Enter the Tiki DB dump file:
read TIKI_DBDUMP
fi

if [ -z "$TIKI_DBDUMP" ] ; then
echo DB dump filename can not be emtpy.
exit 1
fi

if [ -z "$TIKI_DBHOST" ]; then
echo -n Enter the Tiki DB host:
read TIKI_DBHOST
fi

if [ -z "$TIKI_DBNAME" ]; then
echo -n Enter the Tiki DB name:
read TIKI_DBNAME
fi

if [ -z "$TIKI_DBNAME" ] ; then
echo DB name can not be emtpy.
exit 1
fi

if [ -z "$TIKI_DBUSER" ]; then
echo -n Enter the Tiki DB user:
read TIKI_DBUSER
fi

if [ -z "$TIKI_DBPASSWD" ]; then
echo -n Enter the Tiki DB password:
read TIKI_DBPASSWD
fi

# Building auxiliars
[ -z "$TIKI_DBUSER" ]  && db_user='' ||  db_user="-u $TIKI_DBUSER"
[ -z "$TIKI_DBPASSWD" ] && db_passwd='' || db_passwd="-p$TIKI_DBPASSWD"
[ -z "$TIKI_DBHOST" ] && db_host='localhost' || db_host="-h $TIKI_DBHOST"

mysql_command="mysql $db_user $db_passwd $db_host"

pushd $TIKI_PATH
echo "Clear cache"
php console.php -n cache:clear
echo "Update checkout"
bash doc/devtools/svnup.sh
echo "Fix permission"
bash setup.sh mixed
echo "Drop and recreate database"
$mysql_command -e "drop database $TIKI_DBNAME;create database $TIKI_DBNAME"
echo "Populate $TIKI_DBNAME with $TIKI_DBDUMP data"
$mysql_command $TIKI_DBNAME < $TIKI_DBDUMP
echo "Upgrade schema"
php console.php -n database:update
echo "Update search index"
php console.php -n index:rebuild
echo "Update memcache prefix"
$mysql_command $TIKI_DBNAME -e "update tiki_preferences set value = \"DOGFOODtiki_\" where name = \"memcache_prefix\";"
echo "Remove cdn"
$mysql_command $TIKI_DBNAME -e "update tiki_preferences set value = \"\" where name = \"tiki_cdn\";"
echo "Upgrading HTACCESS"
rm .htaccess
sh htaccess.sh on
popd
