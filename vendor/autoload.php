<?php

spl_autoload_register(function ($className){
    include_once dirname(__DIR__) . '/' . str_replace('\\', "/", substr($className,4)) . '.php';
});
