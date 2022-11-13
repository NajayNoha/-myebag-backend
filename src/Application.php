<?php

namespace Src;

use Src\Http\Route;
use Src\Http\Request;

class Application
{
    protected $route;
    protected $request;

    public function __construct()
    {
        $this->request  = new Request;
        $this->route    = new Route($this->request);
    }

    public function run() 
    {
        $this->route->resolve();
    }

}