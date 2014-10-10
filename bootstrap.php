<?php
/**
 * Bootstrap
 *
 * Load project and initialize
 */

define('ABSPATH', dirname(__FILE__));

require 'vendor/autoload.php';

use Aotoki\Sample\Service;

# Setup Database
$databaseConfig = include ABSPATH . "/app/config/database.php";
ORM::configure('mysql:host=' . $databaseConfig["hostname"] . ';dbname=' . $databaseConfig["database"]);
ORM::configure('username', $databaseConfig["username"]);
ORM::configure('password', $databaseConfig["password"]);
ORM::configure('caching', true);
ORM::configure('caching_auto_clear', true);

# Setup View
$twigLoader = new Twig_Loader_Filesystem(ABSPATH . "/app/views");
$twig = new Twig_Environment($twigLoader, [
    "cache" => ABSPATH . "/app/cache",
    "auto_reload" => true
]);

Service::register('view', $twig);


# Setup Router
require ABSPATH . '/app/config/router.php';

# Boot Application
use Aotoki\Sample\Router;
Router::dispatch();
