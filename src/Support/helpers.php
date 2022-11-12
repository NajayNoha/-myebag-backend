<?php


use Src\Application;

if (!function_exists('app')) {
    function app() {
        static $instance = null;

        if(!$instance) {
            $instance = new Application();
        }

        return $instance;
    }
}

if (!function_exists('mysql_spread')) {
    function mysql_spread($arr) {
        return "(`" . implode('`, `', $arr) . "`)";
    }
}

if (!function_exists('base_path')) {
    function base_path() {
        return dirname(__DIR__) . '/../';
    }
}