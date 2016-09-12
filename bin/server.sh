#!/bin/sh

cd `dirname $0`
TEMPLATE_DIR=`dirname $(pwd)`

PORT=8080

read -p "Ingrese el puerto donde correr el servicio (default $PORT):"  input

PORT="${input:-$PORT}"


php -S localhost:$PORT --docroot $TEMPLATE_DIR  --file index.php
