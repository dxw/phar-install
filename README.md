# phar-install

Tool to bundle up contents of vendor/ into vendor.phar file.

This may be useful if you want to put your project in a web-readable directory but you don't want to trawl through all the files in vendor/ to make sure none of them could allow an attacker to do something they shouldn't be able to do.

## Usage

    # install it into a project
    composer require --dev dxw/phar-install=dev-master
    # build vendor.phar
    vendor/bin/phar-install
    # replace "include __DIR__.'/vendor/autoload.php';" with "include __DIR__.'/vendor.phar';"
    vim functions.php

## Copyright

Copyright dxw 2015 - see [COPYING.md](COPYING.md)
