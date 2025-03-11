<?php

declare(strict_types=1);

error_reporting(-1);

ini_set('xdebug.max_nesting_level', '200');

ini_set('memory_limit', '512M');

$vendorDir = __DIR__.'/../vendor';

if (false === is_file($vendorDir.'/autoload.php')) {
    throw new Exception('You must set up the project dependencies, run the following commands:
        wget http://getcomposer.org/composer.phar
        php composer.phar install');
}

$composer = include $vendorDir.'/autoload.php';
$composer->addPsr4('Tests\\', __DIR__);
