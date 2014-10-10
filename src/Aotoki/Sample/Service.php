<?php
/**
 * Class Service
 * @author Aotoki
 */

namespace Aotoki\Sample;

class Service
{
    # Singleton, keep all object fetch same item
    private static $_instance = null;
    private $_services = array();

    private function __construct()
    {
        $this->_services = array();
    }

    public static function getService()
    {
        if(is_null(self::$_instance) || !self::$_instance instanceof Service) {
            self::$_instance = new Service;
        }
        return self::$_instance;
    }

    public static function register($name, $instance, $force = false)
    {
       $service = self::getService();
       if($service->hasService($name) && !$force) {
            return false;
       }
       $service->_services[$name] = $instance;
    }

    public static function get($name, $default = null)
    {
       $service = self::getService();
       if($serivce->hasService($name)) { return $service->_services[$name]; }
       return $default;
    }

    public function hasService($name)
    {
        return array_key_exists($name, $this->_services);
    }

}

