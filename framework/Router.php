<?php

class Router
{

    protected $routes = [];

    public function __construct() {}

    /**
     * Common Register Route method
     *
     * @param [type] $method
     * @param [type] $uri
     * @param [type] $action
     * @return void
     */
    private function registerRoute($method, $uri, $action, $roles = [])
    {

        list($controller, $controllerMethod) = explode("@", $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'roles' => $roles
        ];
    }

    /**
     * Add a GET route
     *
     * @param [string] $uri
     * @param [string] $controller
     * @return void
     */
    public function get($uri, $controller, $roles = [])
    {

        $this->registerRoute('GET', $uri, $controller, $roles);
    }

    /**
     * Add a PUT route
     *
     * @param [string] $uri
     * @param [string] $controller
     * @return void
     */
    public function put($uri, $controller, $roles = [])
    {
        $this->registerRoute('PUT', $uri, $controller, $roles);
    }

    /**
     * Add a POST route
     *
     * @param [string] $uri
     * @param [string] $controller
     * @return void
     */
    public function post($uri, $controller, $roles = [])
    {
        $this->registerRoute('POST', $uri, $controller, $roles);
    }

    /**
     * Add a DELETE route
     *
     * @param [string] $uri
     * @param [string] $controller
     * @return void
     */
    public function delete($uri, $controller, $roles = [])
    {
        $this->registerRoute('DELETE', $uri, $controller, $roles);
    }

    /**
     * Error page
     *
     * @param integer $httpCode
     * @return void
     */
    public function error($httpCode = 404)
    {

        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }

    /**
     * Add the Route method
     *
     * @param [type] $uri
     * @param [type] $method
     * @return void
     */
    public function route($uri)
    {

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Check for _method input
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            // Override the request method with the value of _method
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {
            // Split the current URL into segments

            $uriSegments = explode('/', trim($uri, '/'));

            // Split the current route into segments

            $routeSegments = explode('/', trim($route['uri'], '/'));


            $match = true;

            // Number of segments match

            if (
                count($uriSegments) === count($routeSegments) &&
                strtoupper($route['method'] === $requestMethod)
            ) {
                $params = [];
                $match = true;

                for ($i = 0; $i < count($uriSegments); $i++) {
                    if (
                        $routeSegments[$i] !== $uriSegments[$i] &&
                        !preg_match('/\{(.+?)\}/', $routeSegments[$i])
                    ) {
                        $match = false;
                        break;
                    }

                    // Cehck for the param and add to params array.
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }
                if ($match) {

                    foreach ($route['roles'] as $role) {
                        (new Authorize())->handleRquest($role);
                    }

                    $controller = $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }
        $this->error();
    }
}
