<?php
/**
 * Class Router
 * @author Aotoki
 */

namespace Aotoki\Sample;

use \Pux\Mux;
use \Pux\Executor;

class Router
{
    private static $_instance = null;
    # Base Router
    private $_mux = null;

    # TODO: Router with Prefix using Mux
    # TODO: Before / After hook (or Middleman)

    private function __construct()
    {
        // Let it as a singleton class
        $this->_mux = new Mux;
    }

    private static function getMux()
    {
        if(is_null(self::$_instance) or !self::$_instance instanceof Router) {
            self::$_instance = new Router;
        }
        return self::$_instance->_mux;
    }

    private static function parsePath($path)
    {
        if(strpos('/', $path) == 0) {
            return $path;
        }
        return substr($path, 1);
    }

    private static function parseHandler($handler)
    {
        # NOTE: this only implement 'Controller@action' feature
        if(is_array($handler)) { return $handler; }
        return array_slice(explode('@', $handler), 0, 2);
    }

    # CRUD method
    public static function get($path, $handler)
    {
        $mux = self::getMux();
        $mux->get(self::parsePath($path), self::parseHandler($handler));
    }

    public static function post($path, $handler)
    {
        $mux = self::getMux();
        $mux->post(self::parsePath($path), self::parseHandler($handler));
    }

    public static function put($path, $handler)
    {
        $mux = self::getMux();
        $mux->put(self::parsePath($path), self::parseHandler($handler));
    }

    public static function delete($path, $handler)
    {
        $mux = self::getMux();
        $mux->delete(self::parsePath($path), self::parseHandler($handler));
    }

    # Dispatch
    public static function dispatch()
    {
        if(!array_key_exists("PATH_INFO", $_SERVER)) { $_SERVER["PATH_INFO"] = "/"; }

        self::$_instance->_mux->sort();

        $route = self::$_instance->_mux->dispatch( $_SERVER['PATH_INFO'] );
        $normalNotFound = (!$route[0] && $route[1] != $_SERVER["PATH_INFO"]);
        if($normalNotFound) { // Create 404 not found fallback
            $route = self::$_instance->_mux->dispatch( "/not_found" );
        }

        echo Executor::execute($route);
    }
}

