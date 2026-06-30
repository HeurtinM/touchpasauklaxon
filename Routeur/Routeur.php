<?php
class Routeur {
    private array $routes = [];

    //tableau associatif des routes
    public function addRoute(string $httpMethod, string $url, string $controller, string $method): void {
    $this->routes[$httpMethod . $url] = ['controller' => $controller, 'method' => $method];
    }

    //verifi si la route fourni existe
    //si non renvoi 404
    //si oui recupere et crée une instance du controlleur associer et appelle sa fonction
    public function dispatch(string $url): void {

        $httpMethod = $_SERVER['REQUEST_METHOD']; // récupère GET ou POST
        $key = $httpMethod . $url; // construit la clé ex: "GET/login" ou "POST/login"

        if (array_key_exists($key, $this->routes)) {
            $controller = $this->routes[$key]['controller'];
            $method = $this->routes[$key]['method'];
            require 'App/Controllers/' . $controller . '.php';
            $c = new $controller();
            $c->$method();
        } else {
            echo "404";
        }
    }
}