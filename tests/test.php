<?php

$EXPECTED =[
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
    '.box/.requirements.php',
    '.box/bin/check-requirements.php',
    '.box/src/Checker.php',
    '.box/src/IO.php',
    '.box/src/IsExtensionFulfilled.php',
    '.box/src/IsFulfilled.php',
    '.box/src/IsPhpVersionFulfilled.php',
    '.box/src/Printer.php',
    '.box/src/Requirement.php',
    '.box/src/RequirementCollection.php',
    '.box/src/Terminal.php',
    '.box/vendor/autoload.php',
    '.box/vendor/composer/ClassLoader.php',
    '.box/vendor/composer/LICENSE',
    '.box/vendor/composer/autoload_classmap.php',
    '.box/vendor/composer/autoload_namespaces.php',
    '.box/vendor/composer/autoload_psr4.php',
    '.box/vendor/composer/autoload_real.php',
    '.box/vendor/composer/autoload_static.php',
    '.box/vendor/composer/semver/src/Comparator.php',
    '.box/vendor/composer/semver/src/Constraint/AbstractConstraint.php',
    '.box/vendor/composer/semver/src/Constraint/Constraint.php',
    '.box/vendor/composer/semver/src/Constraint/ConstraintInterface.php',
    '.box/vendor/composer/semver/src/Constraint/EmptyConstraint.php',
    '.box/vendor/composer/semver/src/Constraint/MultiConstraint.php',
    '.box/vendor/composer/semver/src/Semver.php',
    '.box/vendor/composer/semver/src/VersionParser.php',
];

sort($EXPECTED);

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

sort($paths);

if ($paths !== $EXPECTED) {
    echo "TEST FAILED: arrays do not match!\n";
    foreach ($paths as $path) {
        if (!in_array($path, EXPECTED)) {
            echo "- Did not expect to see: $path\n";
        }
    }
    foreach (EXPECTED as $path) {
        if (!in_array($path, $paths)) {
            echo "- Expected to see: $path\n";
        }
    }
    exit(1);
}

echo "Test succeeded!\n";
