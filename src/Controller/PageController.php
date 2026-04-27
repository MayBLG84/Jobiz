<?php

namespace App\Controller; // namespace sert pour éviter la colision de nom (ex: une classe d'un bundle x une classe que l'on a crée)

class PageController
{
    public function testA() // public on utilise pour typer les fonction que pourrons être appeler dehors sa classe
    {
        echo "test !!!";
    }

    public static function testB()
    {
        echo "test d'une fonction statique";
    }

    public function home(): void
    {
        $greeting = "Hello";
        $name = "John";
        $this->render("page/home", [ // tableau de parametres/ associatif
            "greetings" => $greeting,
            "name" => $name,
        ]);
    }

    public function about(): void
    {
        $this->render("page/about");
    }

    // méthode pour gérer le rendu
    protected function render(string $path, array $params = []): void
    {
        $filePath = APP_ROOT . "/templates/$path.php";

        if (!file_exists($filePath)) {
            echo "Le fichier $filePath n'existe pas"; // on expose seulement le path en dev, jamais en prod
        } else {
            // extract transform chaque clé du tableau en variable
            extract($params);
            require_once $filePath;
        }
    }
}
