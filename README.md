# inline-template
Pequeña librería en torno a Twig que permite agrupar plantillas con sus assets (css, js, imágenes) y empaquetarlo todo en un único HTML.

Es ideal para embeber código html que no tenga que estar invocando recursos externos (en principio).

## Bajando el template

Partimos bajando el template inicial vía composer con lo siguiente:

```shell
php composer.phar create-project siu-toba/inline-template carpeta_destino
```
Una vez finalizado, se tendrá instaladas las dependecias necesarias para comenzar a trabajar. 


### Creando el template inline

Por defecto, se proporciona un template inicial llamado index.twig el cual siempre debe existir. A partir de dicho template es posible crear otros que hereden o extiendan su funcionalidad. Ver [la documentación de Twig](http://twig.sensiolabs.org/doc/templates.html) para mayores detalles.


### Probando el template inline 

Para las pruebas locales, se proporciona un comando en el directorio bin que corre el webserver embebido de PHP

```shell
/carpeta_destino/bin/server.sh
```
Al correr el servidor, podremos acceder por url http://localhost/ al template e ir probandolo. Cualquier parámetro nuevo que se dese utilizar desde el template, se deberá agregarlo dentro del archivo index.php


### Utilizando el template inline

Para consumir el template en otros proyectos, primero deberemos agregarlo al composer.json y luego instanciar la clase adecuadamente:

```php
echo \SIU\InlineTemplate\Builder::generateHtml($parametros);
```
Opcionalmente, se puede desabilitar la caché de templates (para trabajar en modo pruebas) de la siguiente forma:

```php
echo \SIU\InlineTemplate\Builder::generateHtml(
    $parametros,
    array('debug' => true)
);
```
