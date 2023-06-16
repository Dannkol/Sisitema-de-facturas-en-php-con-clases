<?php

header('Content-Type: application/json; charset=utf-8');

trait getInstance{
    public static $instance;
    public static function getInstance() {
        $arg = func_get_args();
        $arg = array_pop($arg);
        return (!(self::$instance instanceof self) || !empty($arg)) ? self::$instance = new static(...(array) $arg) : self::$instance;
    }
    function __set($name, $value){
        $this->$name = $value;
    }
    function __get($name){
        return $this->$name;
    }
}

function autoload($class)
{
    $classPaths = array(
        dirname(__DIR__).'/class/' . $class . '.php',
        dirname(__DIR__).'/class/coneccion/' . $class . '.php',
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

$obj = new connect("mysql");

/* class api
{
    use getInstance;
    public function __construct(private $_METHOD, public $_HEADER, private $_DATA)
    {

        $res = match ($_METHOD) {
            'POST' => factura::getInstance($_DATA['header'])
        };

        var_dump($res);
    }
}

api::getInstance(["_METHOD" => $_SERVER['REQUEST_METHOD'], "_HEADER" => apache_request_headers(), "_DATA" => json_decode(file_get_contents('php://input'), true)]);


 */