<?php


namespace App;


class Router
{

    public $uri;
    public $method;
    public $routes;
    public static $model;

    public function __construct()
    {
        $this->uri = explode('?', $_SERVER['REQUEST_URI']);
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->routes = json_decode(file_get_contents(__DIR__ . '/../routes.json'), true);

        self::$model = str_replace('/', '', $this->uri[1]);
    }

}