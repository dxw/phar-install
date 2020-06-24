# phar-install is DEPRECATED

Please use `humbug/box` to bundle contents of `vendor/` into a `vendor.phar` file.

## Usage

Add `humbug/box`:

```sh
composer require --dev humbug/box
```

Add a `box.json` file to your project:

```json
{
  "directories": ["vendor/"],
  "output": "vendor.phar",
  "main": false
}
```

Then add the following to `composer.json`:

```json
  "scripts": {
    "post-update-cmd": "vendor/bin/box compile"
  },
```

`vendor.phar` will be rebuilt automatically every time `composer update` or `composer require` is run.

Now just replace `require(__DIR__.'/vendor/autoload.php');` with `require(__DIR__.'/vendor.phar');`.
