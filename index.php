<?php
require_once 'vendor/autoload.php';


$navigation = array(
    array('href' => 'www.google.com', 'caption' => 'googlddde'),
    array('href' => 'www.google.com', 'caption' => 'googlffe'),
    array('href' => 'www.google.com', 'caption' => 'googlgge'),
);

echo \SIU\InlineTemplate\Builder::generateHtml(
    array('a_variable' => 'Sergio', 'navigation' => $navigation),
    array('debug' => true)
);
