<?php

namespace SIU\InlineTemplate;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_SimpleFunction;

class InlineTemplateBuilder {

    const BASE_DIR = __DIR__.'/../../..';

    static public function generateHtml($parameters, $options = null)
    {
        $templatesDir = self::BASE_DIR.'/templates';

        $loader = new Twig_Loader_Filesystem($templatesDir);

        $twig = new Twig_Environment($loader, self::getOptions($options));

        self::addFunctions($twig);

        $template = $twig->loadTemplate('index.twig');

        $html = $template->render($parameters);

        return $html;
    }

    static private function addFunctions(Twig_Environment $twig)
    {
        $function = new Twig_SimpleFunction('inline_js', function ($js) {
            $path = realpath(self::BASE_DIR).'/js/'.$js;

            if (!is_file($path)){
                throw new \Exception("No se puede encontrar '$path'");
            }

            return $path;
        });

        $twig->addFunction($function);

        $function = new Twig_SimpleFunction('inline_css', function ($js) {
            $path = realpath(self::BASE_DIR).'/css/'.$js;

            if (!is_file($path)){
                throw new \Exception("No se puede encontrar '$path'");
            }

            return $path;
        });

        $twig->addFunction($function);

        $function = new Twig_SimpleFunction('inline_img', function ($js) {
            $path = realpath(self::BASE_DIR).'/img/'.$js;

            if (!is_file($path)){
                throw new \Exception("No se puede encontrar '$path'");
            }

            return $path;
        });

        $twig->addFunction($function);
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
