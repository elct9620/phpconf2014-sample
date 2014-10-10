<?php
/**
 * Class BaseController
 * @author Aotoki
 */

namespace Aotoki\Sample;

class BaseController
{
    public function __construct()
    {
    }

    public function __get($name)
    {
        # NOTE: This example only use service object
        return Service::get($name);
    }
}

