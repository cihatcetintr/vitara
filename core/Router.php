<?php

namespace Core;

class Router
{
    protected array $routes = [];
    protected array $middlewares = [];
    protected array $params = [];
    
    public function add(string $uri, array $controller, array $middleware = []): void
    {
        // URI'daki parametreleri regex pattern'larına dönüştür
        $pattern = $this->convertUriToRegex($uri);
        
        $this->routes[$pattern] = $controller;
        if (!empty($middleware)) {
            $this->middlewares[$pattern] = $middleware;
        }
    }
    
    protected function convertUriToRegex(string $uri): string
    {
        // Regex pattern'ları için {\\d+} -> (\d+)
        $pattern = preg_replace('/\{\\\\(\w+)\+\}/', '($1+)', $uri);
        
        // Optional parametreler için {param?} -> (?:/([^/]+))?
        $pattern = preg_replace('/\/{([^?}]+)\?}/', '(?:/([^/]+))?', $pattern);
        
        // Normal parametreler için {param} -> ([^/]+)
        $pattern = preg_replace('/{([^}]+)}/', '([^/]+)', $pattern);
        
        return '#^' . $pattern . '$#';
    }
    
    public function match(string $uri): bool
    {
        foreach ($this->routes as $pattern => $controller) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // İlk eşleşmeyi kaldır
                $this->params = $matches;
                return true;
            }
        }
        return false;
    }
    
    public function dispatch(string $uri)
    {
        if ($this->match($uri)) {
            $pattern = array_search($this->getCurrentRoute(), $this->routes);
            
            // Middleware kontrolü
            if (isset($this->middlewares[$pattern])) {
                foreach ($this->middlewares[$pattern] as $middleware) {
                    $middlewareInstance = new $middleware();
                    $middlewareInstance->handle();
                }
            }
            
            $controller = $this->getCurrentRoute()[0];
            $action = $this->getCurrentRoute()[1];
            
            $controllerInstance = new $controller();
            return call_user_func_array([$controllerInstance, $action], $this->params);
        }
        
        throw new \Exception('No route matched.');
    }
    
    protected function getCurrentRoute(): array
    {
        foreach ($this->routes as $pattern => $controller) {
            if (preg_match($pattern, $_SERVER['REQUEST_URI'], $matches)) {
                return $controller;
            }
        }
        return [];
    }
} 