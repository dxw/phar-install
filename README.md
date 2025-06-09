# phar-install

Tool to bundle up contents of `vendor/` into `vendor.phar` file.

This may be useful if you want to put your project in a web-readable directory but you don't want to trawl through all the files in `vendor/` to make sure none of them could allow an attacker to do something they shouldn't be able to do.

## Usage

Add the following to `composer.json`:

```
  "scripts": {
    "post-update-cmd": "vendor/bin/phar-install"
  },
```

Add phar-install:

```
composer require --dev dxw/phar-install
```

`vendor.phar` will be rebuilt automatically every time `composer update` or `composer require` is run.

Now just replace `require(__DIR__.'/vendor/autoload.php');` with `require(__DIR__.'/vendor.phar');`.

### Get composer's autoloader

You can also get access to the autoloader object if needed. The phar file will return the autoloader. With this functionality you can add on your own project's namespaced files into the autoloader.

```php
$autoload = require_once __DIR__ . '/vendor.phar';
$autoload->add('MyNamespace', __DIR__ . '/src');
```

## Deployed WordPress paths

For WordPress developers, any path created by Composer for the
autoloader is automatically re-written so that:

    /path/to/wp-content/...

becomes:

    /var/www/html/wp-content/...

The path prefix can be controlled by setting the `PHAR_INSTALL_PATH_TO_WP_CONTENT`
environment variable.

By default, Composer hard-codes absolute paths in classmaps,
and if you run `phar-install` on a development machine then
deploy the phar file to a live environment, you may see error
messages that reflect the contents of the classmap, rather
than the structure of your application.

The re-write that `phar-install` performs is intended to ensure
that classes take less time to load and that your error messages
are consistent with the files you see on disk.

## Copyright

Copyright dxw 2015 - see [COPYING.md](COPYING.md)
