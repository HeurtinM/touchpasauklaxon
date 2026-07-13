<?php

/**
 * Classe gérant le routage des requêtes HTTP vers les contrôleurs appropriés
 */
class Routeur {

    /** @var array Tableau associatif des routes enregistrées */
    private array $routes = [];

    /**
     * Enregistre une nouvelle route dans le tableau des routes
     * La clé est construite en combinant la méthode HTTP et l'URL
     * 
     * @param string $httpMethod Méthode HTTP (GET ou POST)
     * @param string $url URL de la route
     * @param string $controller Nom du contrôleur associé
     * @param string $method Nom de la méthode à appeler
     * @return void
     */
    public function addRoute(string $httpMethod, string $url, string $controller, string $method): void {
        $this->routes[$httpMethod . $url] = ['controller' => $controller, 'method' => $method];
    }

    /**
     * Vérifie si la route fournie existe et appelle le contrôleur associé
     * Sépare l'URL des paramètres GET avant de chercher la route
     * Renvoie une erreur 404 si la route n'existe pas
     * 
     * @param string $url URL de la requête courante
     * @return void
     */
    public function dispatch(string $url): void {
        $url = strtok($url, '?'); 
        $httpMethod = $_SERVER['REQUEST_METHOD']; 
        $key = $httpMethod . $url;

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