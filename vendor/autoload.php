<?php

require_once "Psr4AutoloaderClass.php";

$loader = new App\Vendor\Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('App\Core', __DIR__."/../core/");
