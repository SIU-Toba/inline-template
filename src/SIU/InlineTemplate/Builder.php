<?php

namespace SIU\InlineTemplate;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
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
     * @param array  $parameters los parámetros que se utilizarán en el template
     * @param arrya  $options    opciones particulares. @see Twig_Environment
     * @param Logger $logger     para guardar los logs
     *
     * @return string HTML con contenido y assets inline
     *
     * @throws \Exception Cuando no se puede cargar o procesar los templates
     */
    public static function generateHtml($parameters, $options = null, Logger $logger = null)
    {
        if ($logger === null) {
            $logger = new Logger('MAIN');
            $handler = new StreamHandler(self::BASE_DIR.'inline-template.log', null, null, 0666);
            $handler->setFormatter(new LineFormatter("%message%\n", null, true));
            $logger->pushHandler($handler);
        }

        try {
            $loader = new Twig_Loader_Filesystem(self::BASE_DIR.'/templates');

            $twig = new Twig_Environment($loader, self::getOptions($options));

            $twig->addExtension(new Assets(self::BASE_DIR, $logger));

            $template = $twig->loadTemplate('index.twig');

            $html = $template->render($parameters);

            return $html;
        } catch (Twig_Error_Loader $exc) {
            $logger->error($exc->getTraceAsString());

            throw new \Exception('No es posible acceder a '.self::BASE_DIR.'/templates/index.twig');
        } catch (Twig_Error $exc) {
            $logger->error($exc->getTraceAsString());

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
