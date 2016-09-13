<?php

namespace SIU\InlineTemplate\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Extensión de Twig Assets.
 *
 * Engloba las funciones implementadas para InlineTemplate y utilizadas en
 * templates tipo Twig.
 *
 * @author Sergio Fabián Vier <svier@siu.edu.ar>
 */
class Assets extends Twig_Extension
{
    protected $functions = array();

    public function getName()
    {
        return 'inlinetemplate';
    }

    public function getFunctions()
    {
        return array(
            $this->inlineJs(),
            $this->inlineCss(),
            $this->inlineImg(),
        );
    }

    private function inlineJs()
    {
        $function = new Twig_SimpleFunction('inline_js', function ($js) {
            $path = realpath($this->baseDir).'/js/'.$js;

            if (!is_readable($path)) {
                throw new \Exception("No se puede leer '$path'");
            }

            $file = file_get_contents($path);

            return "<script language=\"javascript\">$file</script>";
        }, array('is_safe' => array('html')));

        return $function;
    }

    private function inlineCss()
    {
        $function = new Twig_SimpleFunction('inline_css', function ($js) {
            $path = realpath($this->baseDir).'/css/'.$js;

            if (!is_readable($path)) {
                throw new \Exception("No se puede leer '$path'");
            }

            $file = file_get_contents($path);

            return "<style>$file</style>";
        }, array('is_safe' => array('html')));

        return $function;
    }

    private function inlineImg()
    {
        $function = new Twig_SimpleFunction('inline_img', function ($js) {
            $path = realpath($this->baseDir).'/img/'.$js;

            if (!is_readable($path)) {
                throw new \Exception("No se puede leer '$path'");
            }

            $file = base64_encode(file_get_contents($path));

            return "<img src=\"data:image/jpeg;base64,$file\"/>";
        }, array('is_safe' => array('html')));

        return $function;
    }
}
