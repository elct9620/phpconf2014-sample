<?php
/**
 * Bootstrap
 *
 * Load project and initialize
 */

define('ABSPATH', dirname(__FILE__));

require 'vendor/autoload.php';

# Setup Database
// TODO: Add idiorm configure

# Setup View
$twigLoader = new Twig_Loader_Filesystem(ABSPATH . "/app/views");
$twig = new Twig_Environment($twigLoader, [
    "cache" => ABSPATH . "/app/cache",
    "auto_reload" => true
]);


# Setup Router
require ABSPATH . '/app/config/router.php';

# Boot Application
use Aotoki\Sample\Router;
Router::dispatch();
