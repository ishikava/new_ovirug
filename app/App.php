<?php


namespace App;


class App
{

    public static $config;
    public static $parser;
    public static $log;
    public static $router;

    public function __construct()
    {

        self::$config = new Config();

        self::$parser = new Parser();

        self::$log = new Logger();

        self::$router = new Router();

        if( self::$config->get('display_errors') ){
            ini_set("display_errors", "1");
            error_reporting(E_ALL);
        }

        $route = array_search(self::$router->uri[0], array_column(self::$router->routes, 'uri'));

        if($route === false){
            App::$log->log('error', '404 Not Found');
            header("HTTP/1.1 404 Not Found");
            echo '404 Not Found';
            exit;
        }

        if(self::$router->routes[$route]['method'] !== self::$router->method ){
            App::$log->log('error', '405 Method Not Allowed');
            header("HTTP/1.1 405 Method Not Allowed");
            echo '405 Method Not Allowed';
            exit;
        }

        $auth = new Auth();
        if(!$auth->isAuth(self::$router->routes[$route]['auth'])){
            App::$log->log('error', '401 Unauthorized');
            header("HTTP/1.1 401 Unauthorized");
            echo '401 Unauthorized';
            exit;
        }

        if (self::$router->routes[$route]['soap_server']) {
            //работаем как SOAP сервер
            $server = new \SoapServer('.'.self::$router->routes[$route]['uri'] . '.wsdl',
                array('soap_version' => SOAP_1_1, 'cache_wsdl' => WSDL_CACHE_NONE));
            $server->setClass('\App\Soap');
            $server->handle();
        } else {
            $class_name = '\App\\'.self::$router->routes[$route]['class'];
            $class = new $class_name();
            $action = self::$router->routes[$route]['action'];
            $class->$action(file_get_contents('php://input'));
        }

    }

}