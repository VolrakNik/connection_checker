<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb035160f124ef4bd3cbf324ce0756c96
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Script\\' => 7,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'C' => 
        array (
            'Common\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Script\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Script',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Common\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Common/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb035160f124ef4bd3cbf324ce0756c96::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb035160f124ef4bd3cbf324ce0756c96::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb035160f124ef4bd3cbf324ce0756c96::$classMap;

        }, null, ClassLoader::class);
    }
}
