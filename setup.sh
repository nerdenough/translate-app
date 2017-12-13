#!/bin/bash
# Creates the database with seed data.
docker exec translate_db sh -c 'mysql -u root -proot -e "ALTER DATABASE translate CHARACTER SET utf8 COLLATE utf8_unicode_ci"'
docker exec translate_db sh -c 'mysql -u root -proot translate < /tmp/db.sql'
