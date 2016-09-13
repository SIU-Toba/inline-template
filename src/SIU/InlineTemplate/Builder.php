<?php

namespace SIU\InlineTemplate;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Error;
use Twig_Error_Loader;
use SIU\InlineTemplate\Extension\Assets;

/**
 * Builder de templates Twig.
 *
 * Wrapper sobre Twig que implementa templates inline.
 *
 * @author Sergio Fabián Vier <svier@siu.edu.ar>
 */
class Builder
{
    const BASE_DIR = __DIR__.'/../../..';

    /**
     * Genera el HLML con contenido inline de todos los templates y assets.
     *
     * @param array $parameters los parámetros que se utilizarán en el template
     * @param arrya $options    opciones particulares. @see Twig_Environment
     *
     * @return string HTML con contenido y assets inline
     *
     * @throws \Exception Cuando no se puede cargar o procesar los templates
     */
    public static function generateHtml($parameters, $options = null)
    {
        try {
            $loader = new Twig_Loader_Filesystem(self::BASE_DIR.'/templates');

            $twig = new Twig_Environment($loader, self::getOptions($options));

            $twig->addExtension(new Assets(self::BASE_DIR));

            $template = $twig->loadTemplate('index.twig');

            $html = $template->render($parameters);

            return $html;
        } catch (Twig_Error_Loader $exc) {

            //TODO: mandar a log esto? $exc->getTraceAsString();

            throw new \Exception('No es posible acceder a '.self::BASE_DIR.'/templates/index.twig');
        } catch (Twig_Error $exc) {

            //TODO: mandar a log esto? $exc->getTraceAsString();

            throw new \Exception('Ocurrió un error al procesar el template: '.$exc->getMessage());
        }
    }

    /**
     * Sanitiza las opciones.
     *
     * @see Twig_Environment
     *
     * @param array $options
     *
     * @return array
     */
    private static function getOptions($options)
    {
        $default = [
            'cache' => self::BASE_DIR.'/cache',
            'debug' => false,
        ];

        $default = array_unique(array_merge($default, $options));

        return $default;
    }
}
