<?php
class Router
{
    private static $routes = [];

    public static function addRoute($method, $url, $callback)
    {
        self::$routes[$method][$url] = $callback;
    }

    public static function handleRequest($url, $method)
    {
        $url = trim($url, '/');
        $segments = explode('/', $url);

        foreach (self::$routes[$method] as $route => $callback) {
            $routeSegments = explode('/', trim($route, '/'));

            if (count($segments) !== count($routeSegments)) {
                continue;
            }

            $params = [];

            for ($i = 0; $i < count($segments); $i++) {
                if ($routeSegments[$i] === $segments[$i]) {
                    continue;
                }

                if ($routeSegments[$i] === '{id}') {
                    $params['id'] = (int) $segments[$i];
                    continue;
                }

                var_dump($params['id']);
                $params['id'] = $params['id'] == 0 ? 'NaN' : $params['id'];

                // No coincide, pasar a la siguiente ruta
                continue 2;
            }
            //compruebo que id sea solo un numero entrero 
            if ((strlen($params['id']) == strlen($segments[1]))) {
                //llamar al callback con los parámetros
                //Llama a la llamda de retorno dada por el primer parámetro callback con los parámetros de param_arr. 
                call_user_func_array($callback, $params);
                return;
            } elseif ($params['id'] == 'NaN') {
                call_user_func($callback);
                return;
            }
        }

        http_response_code(404);
        echo json_encode([
            "Code" => 404,
            "Message" => 'Ruta no encontrada',
        ]);
    }
}
