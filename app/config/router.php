<?php
use Aotoki\Sample\Router;

Router::get('/', 'HomeController@index');
Router::post('/', 'HomeController@create');
