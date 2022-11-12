<?php

namespace Src;

use Src\Http\Route;
use Src\Http\Request;
use Src\Http\Response;

class Application
{
    protected $route;
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->request  = new Request;
        $this->response = new Response;
        $this->route    = new Route($this->request, $this->response);
    }

    public function run() 
    {
        $this->route->resolve();
    }

}