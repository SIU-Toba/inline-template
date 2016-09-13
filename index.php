<?php
require_once 'vendor/autoload.php';


$navigation = [
    array('href' => 'http://www.google.com', 'caption' => 'Buscar en Google'),
];

$parametros = [
    'template_variable' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.',
    'navigation' => $navigation,
    'otra_variable' => 'otro-valor',
];

echo \SIU\InlineTemplate\Builder::generateHtml(
    $parametros,
    array('debug' => true)
);
