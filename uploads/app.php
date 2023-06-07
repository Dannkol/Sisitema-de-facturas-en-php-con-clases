<?php

header('Content-Type: application/json; charset=utf-8');
$_DATA = json_decode(file_get_contents('php://input'), true);

function autoload($class)
{
    $classPaths = array(
        dirname(__DIR__).'/api/db/' . $class . '.php',
        dirname(__DIR__).'/api/user/' . $class . '.php',
        dirname(__DIR__).'/api/' . $class . '.php',
        dirname(__DIR__).'/' . $class . '.php',

    );

    foreach ($classPaths as $path) {
        if (file_exists($path)) {
            require $path;
            return;
        }
    }
}

spl_autoload_register('autoload');

echo dirname(__DIR__);
