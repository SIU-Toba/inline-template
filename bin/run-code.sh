#!/bin/sh

cd `dirname $0`
TEMPLATE_DIR=`dirname $(pwd)`

php -S localhost:8080 --docroot $TEMPLATE_DIR  --file index.php
