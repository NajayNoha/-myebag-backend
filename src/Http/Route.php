<?php

namespace Src\Http;

class Route
{
    public static $routes = [];
    protected $request;


    public function __construct($request)
    {
        $this->request  = $request;
    }


    public static function get($route, $action)
    {
        self::$routes['get'][$route] = $action;
    } 


    public static function post($route, $action)
    {
        self::$routes['post'][$route] = $action;
    } 



    public  function resolve()
    {
        $method = $this->request->method();
        $path   = $this->request->path();

        // Handling Error404 Path is not found
        if (!array_key_exists($path, self::$routes[$method])) {
            
            print_r(\json_encode([
                "message" => "Route not found 404"
            ]));
            exit();
            
        }


        $action = self::$routes[$method][$path];

        // Setting the response as json
        header('Content-Type: application/json');

        // If the action that's passew is a closure and it's callable
        if(is_callable($action)) {
            call_user_func_array($action, []);
        }

        // If the action that's passed is an array
        if(is_array($action)) {
            call_user_func_array([new $action[0], $action[1]], []);
        }


    }
}