<?php

namespace SIU\InlineTemplate;

use Twig_Loader_Filesystem;
use Twig_Environment;

use SIU\InlineTemplate\Extension\Assets;

class Builder {

    const BASE_DIR = __DIR__.'/../../..';

    static public function generateHtml($parameters, $options = null)
    {
        $loader = new Twig_Loader_Filesystem(self::BASE_DIR.'/templates');

        $twig = new Twig_Environment($loader, self::getOptions($options));

        $twig->addExtension(new Assets(self::BASE_DIR));

        $template = $twig->loadTemplate('index.twig');

        $html = $template->render($parameters);

        return $html;
    }

    static private function getOptions($options)
    {
        $default = [
            'cache' => self::BASE_DIR.'/cache',
            'debug' => false,
        ];

        $default = array_unique(array_merge($default, $options));

        return $default;
    }
}
