<?php

namespace App\Routing;

use App\Controller\ErrorController;

class Router
{
    private $routes;
    public function __construct()
    {
        $this->routes = require_once APP_ROOT . "/config/routes.php";
    }

    // Géstion de rêquete
    public function handleRequest(string $uri)
    {
        try {
            $path = $this->normalizePath($uri); // Normalisation de l’URI afin de correspondre aux routes définies dans /config/routes.php
            if (!isset($this->routes[$path])) { // Vérification de l’existence de la route correspondante
                throw new \Exception("La route n'existe pas"); // On utilise "\" pour indiquer que il faut checher à la racine (native PHP). Option B: "use"
            }
            $route = $this->routes[$path]; // Récupération des informations complètes de la route correspondante

            $controllerPath = $route["controller"]; // Récupération du contrôleur path associé à la route
            $action = $route["action"]; // Récupération de l’action à exécuter

            if (!class_exists($controllerPath)) { // Vérification de l’existence de la classe du contrôleur
                throw new \Exception("La classe n'existe pas");
            }
            $controller = new $controllerPath(); // Instanciation du contrôleur

            if (!method_exists($controller, $action)) { // Vérification de l’existence de la méthode à appeler
                throw new \Exception("Le méthode n'existe pas");
            }
            $controller->$action(); // Appel dynamique de la méthode (action) du contrôleur
        } catch (\Exception $e) {
            $errorController = new ErrorController; // Instanciation du contrôleur d'erreur
            $errorController->show($e->getMessage()); // Affichage du message d’erreur via la méthode show()
        }
    }

    public static function normalizePath(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $path = rtrim($path, "/") . "/";
        return $path;
    }
}
