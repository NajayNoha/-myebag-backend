<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc6d0992e0e029c7df530ace22afa259b
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc6d0992e0e029c7df530ace22afa259b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc6d0992e0e029c7df530ace22afa259b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc6d0992e0e029c7df530ace22afa259b::$classMap;

        }, null, ClassLoader::class);
    }
}