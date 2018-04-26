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

## Copyright

Copyright dxw 2015 - see [COPYING.md](COPYING.md)
