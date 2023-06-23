<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

header('application/json');

require 'uploads/app.php';


//creo una ruta de getall clientes

Router::addRoute('GET', '/clientes/', function () {
    cliente::getAllClient();
});

//creo una ruta de getall clientes

Router::addRoute('GET', '/cliente/{id}', function ($id) {
    cliente::getccClient($id);
});

//creo una ruta de delete para clientes
Router::addRoute('DELETE', '/cliente/{id}', function ($id) {
    cliente::delete($id);
});

//actualizo un cliente
Router::addRoute('PUT', '/cliente/{id}', function ($id) {
    cliente::update($id, json_decode(file_get_contents('php://input'), true));
});

//creo un cliente
Router::addRoute('POST', '/clientes/', function () {
    cliente::postClient(json_decode(file_get_contents('php://input'), true));
});

//RUTAS PARA FACTURA

//creo una factura
Router::addRoute('POST', '/bill/', function(){
    factura::post(json_decode(file_get_contents('php://input'), true));
});

//getall factura
Router::addRoute('GET', '/bills/', function(){
    factura::getAll(json_decode(file_get_contents('php://input'), true));
});

//getid
Router::addRoute('GET', '/bill/{id}', function($id){
    factura::getid($id);
});

//DELATE facturas
Router::addRoute('DELETE', '/bill/{id}', function($id){
    factura::delete($id);
});

//Update facturas
Router::addRoute('PUT', '/bill/{id}', function($id){
    factura::update($id, json_decode(file_get_contents('php://input'), true));
});

//verifico si la ruta concide con alguna de mis rutas creadas previamente
$url = isset($_GET['url']) ? $_GET['url'] : '';
$method = $_SERVER['REQUEST_METHOD'];

Router::handleRequest($url, $method);
