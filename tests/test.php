<?php

const EXPECTED =[
    'vendor/aura/autoload/.scrutinizer.yml',
    'vendor/aura/autoload/.travis.yml',
    'vendor/aura/autoload/CHANGES.md',
    'vendor/aura/autoload/CONTRIBUTING.md',
    'vendor/aura/autoload/LICENSE',
    'vendor/aura/autoload/README.md',
    'vendor/aura/autoload/autoload.php',
    'vendor/aura/autoload/composer.json',
    'vendor/aura/autoload/phpunit.php',
    'vendor/aura/autoload/phpunit.xml.dist',
    'vendor/aura/autoload/src/Loader.php',
    'vendor/aura/autoload/tests/Bar.php',
    'vendor/aura/autoload/tests/Baz/Qux/Quux.php',
    'vendor/aura/autoload/tests/Foo.php',
    'vendor/aura/autoload/tests/LoaderTest.php',
    'vendor/autoload.php',
    'vendor/composer/ClassLoader.php',
    'vendor/composer/LICENSE',
    'vendor/composer/autoload_classmap.php',
    'vendor/composer/autoload_namespaces.php',
    'vendor/composer/autoload_psr4.php',
    'vendor/composer/autoload_real.php',
    'vendor/composer/autoload_static.php',
    'vendor/composer/installed.json',
    'vendor/dxw/iguana/.gitignore',
    'vendor/dxw/iguana/.php_cs',
    'vendor/dxw/iguana/.travis.yml',
    'vendor/dxw/iguana/COPYING.md',
    'vendor/dxw/iguana/README.md',
    'vendor/dxw/iguana/composer.json',
    'vendor/dxw/iguana/composer.lock',
    'vendor/dxw/iguana/phpunit.xml',
    'vendor/dxw/iguana/src/Init.php',
    'vendor/dxw/iguana/src/Registerable.php',
    'vendor/dxw/iguana/src/Registrar.php',
    'vendor/dxw/iguana/src/Value/ArrayBase.php',
    'vendor/dxw/iguana/src/Value/Cookie.php',
    'vendor/dxw/iguana/src/Value/Get.php',
    'vendor/dxw/iguana/src/Value/Post.php',
    'vendor/dxw/iguana/src/Value/Server.php',
    'vendor/dxw/iguana/tests/registrar_test.php',
    'vendor/dxw/iguana/tests/value/array_base_test.php',
    'vendor/dxw/iguana/tests/value/cookie_test.php',
    'vendor/dxw/iguana/tests/value/get_test.php',
    'vendor/dxw/iguana/tests/value/post_test.php',
    'vendor/dxw/iguana/tests/value/server_test.php',
];

const VENDORPHAR = 'vendor.phar';

$phar = new Phar(VENDORPHAR, FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME);

$paths = [];
foreach (new \RecursiveIteratorIterator($phar) as $file) {
    $relativePath = $file->getPathname();
    $prefix = 'phar://'.realpath(VENDORPHAR).'/';
    if (strpos($file->getPathname(), $prefix) !== 0) {
        echo "ERROR\n";
        exit(1);
    }

    $relativePath = substr($file->getPathname(), strlen($prefix));
    $paths[] = $relativePath;
}

if ($paths !== EXPECTED) {
    echo "TEST FAILED: arrays do not match!\n";
    exit(1);
}

echo "Test succeeded!\n";
