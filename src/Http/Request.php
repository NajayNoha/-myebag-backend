<?php 


namespace myebag\Http ;

class Request {
    public function methode(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function path(){
        $path = $_SERVER['REQUEST_URI'];
        return str_contains($path, "?") ? explode("?",$path)[0] : $path;
    }
} 