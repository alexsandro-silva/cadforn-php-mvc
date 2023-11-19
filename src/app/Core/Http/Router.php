<?php

namespace App\Core\Http;

use Exception;

class Router
{
    private string $url;
    private string $prefix;
    private array $routes = [];
    private Request $request;

    public function __construct(string $url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    private function setPrefix(): void
    {
        $parsedUrl = parse_url($this->url);
        $this->prefix = $parsedUrl['path'] ?? '';
    }

    private function makeUriPattern(string $uri): string
    {
        if (preg_match("(:\w+)", $uri)) {
            return preg_replace("(:\w+)", '(\w+)', $uri);
        }

        return $uri;
    }

    private function addRoute(string $method, string $route, string $controller)
    {
        $routePattern = $this->makeUriPattern('/'.str_replace('/', '\/', $route).'$/');
        $this->routes[$routePattern][$method] = array_combine(['controller', 'action'], explode('@', $controller));
    }

    public function get(string $route, string $controller): void
    {
        $this->addRoute('GET', $route, $controller);
    }

    private function getUri()
    {
        $uri = $this->request->getUri();
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($xUri);
    }

    private function getRoute()
    {
        $uri = $this->getUri();
        $httpMethod = $this->request->getHttpMethod();
        foreach ($this->routes as $routePattern => $methods) {
            if (preg_match($routePattern, $uri, $matches)) {
                if ($methods[$httpMethod]) {
                    array_shift($matches);
                    $methods[$httpMethod]['params'] = $matches;
                    return $methods[$httpMethod];
                }

                throw new Exception('Method no allowed', HttpStatus::METHOD_NOT_ALLOWED);
            }
        }

        throw new Exception('URL not found', HttpStatus::NOT_FOUND);
    }

    public function run()
    {
        try {
            $route = $this->getRoute();
            if (!isset($route['controller'])) {
                throw new Exception('Error processing request', HttpStatus::INTERNAL_SERVER_ERROR);
            }

            $args = $route['params'] ?? [];

            $controllerInstance = new $route['controller'];

            return call_user_func_array(array($controllerInstance, $route['action']), $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}