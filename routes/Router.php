<?php
class Router
{
    private static $routes = [];


    //creo una nueva ruta Router::addRoute(METHOD, URL, CALLBACK)

    public static function addRoute($method, $url, $callback)
    {
        self::$routes[$method][$url] = $callback;
    }


    //verifica si la ruta a la que intento acceder
    //si es valida y extra el parametro de id
    //metodo usado por cuestion de seguridad
    //evita inyeccion de datos por medio de las rutas
    public static function handleRequest($url, $method)
    {
        $url = trim($url, '/');
        $segments = explode('/', $url);

        
        foreach (self::$routes[$method] as $route => $callback) {
            $routeSegments = explode('/', trim($route, '/'));


/*             print_r($routeSegments);
            print_r($segments);
            var_dump(count($routeSegments));
            var_dump(count($segments));



            var_dump(count($segments) !== count($routeSegments)); */

            // Verificar si el número de segmentos coincide 
            // la funcion espera tener dos parametros 
            // por ejemplo ruta1/{id} por lo tanto valida si
            // los fueron enviados todos los parametros

            if (count($segments) !== count($routeSegments)) {
                continue;
            }

            $params = [];

            //creo mi parametro id
            $params['id'] = (int) $segments[1];


            $params['id'] = $params['id'] == 0 ? 'NaN' : $params['id'];

            //compruebo que id sea solo un numero entrero 
            if ((strlen($params['id']) == strlen($segments[1]))) {
                //llamar al callback con los parámetros
                //Llama a la llamda de retorno dada por el primer parámetro callback con los parámetros de param_arr. 
                call_user_func_array($callback, $params);
                return;
            } elseif ($params['id'] == 'NaN'){
                call_user_func($callback);
                return;
            }
        }

        http_response_code(404);


        echo json_encode([
            "Code" => 404, 
            "Message" => 'Ruta no encontrada'
        ]);
    }
}
