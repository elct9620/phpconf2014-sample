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
// TODO: Add Twig configure

# Setup Router
require ABSPATH . '/app/config/router.php';

# Boot Application
use Aotoki\Sample\Router;
Router::dispatch();
