<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1de52759ba01e6510a7f4ef3e12a0362
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1de52759ba01e6510a7f4ef3e12a0362::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1de52759ba01e6510a7f4ef3e12a0362::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1de52759ba01e6510a7f4ef3e12a0362::$classMap;

        }, null, ClassLoader::class);
    }
}
