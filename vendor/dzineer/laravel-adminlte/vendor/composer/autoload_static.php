<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit64294ce222b40edeffe9d2d7a3e0ec3a
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dzineer\\LaravelAdminLte\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dzineer\\LaravelAdminLte\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit64294ce222b40edeffe9d2d7a3e0ec3a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit64294ce222b40edeffe9d2d7a3e0ec3a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
