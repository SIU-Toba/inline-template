<?php

namespace SIU\InlineTemplate;

use Twig_Loader_Filesystem;
use Twig_Environment;

class InlineTemplateBuilder {

    static public function generateHtml($parameters, $options = null)
    {
        $templatesDir = __DIR__.'/../../../templates';

        $loader = new Twig_Loader_Filesystem($templatesDir);

        $twig = new Twig_Environment($loader, self::getOptions($options));

        $template = $twig->loadTemplate('index.twig');

        $html = $template->render($parameters);

        return $html;
    }

    static private function getOptions($options)
    {
        $default = [
            'cache' => __DIR__.'/../../../cache',
            'debug' => false,
        ];

        $default = array_unique(array_merge($default, $options));

        return $default;
    }
}
