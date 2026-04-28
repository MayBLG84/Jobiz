<?php

namespace App\Controller;

class Controller
{
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
