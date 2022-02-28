<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit593c70917a061584330b931f5cb6f4ef
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'eftec\\bladeone\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'eftec\\bladeone\\' => 
        array (
            0 => __DIR__ . '/..' . '/eftec/bladeone/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit593c70917a061584330b931f5cb6f4ef::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit593c70917a061584330b931f5cb6f4ef::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit593c70917a061584330b931f5cb6f4ef::$classMap;

        }, null, ClassLoader::class);
    }
}