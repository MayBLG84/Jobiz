<?php

//Charger l'autoload
require_once __DIR__ . "/../vendor/autoload.php";

// On définit une constante pour avoir le chemin racine de l'app
define('APP_ROOT', dirname(__DIR__));

use App\Controller\PageController as PageController; // l'alias permet de manipuler la classe quand il y a plusieurs classe avec le même nom

$pageController = new PageController; // l'instanciation
/* //autocompletion -> extension PHP Intelephense
$pageController->testA(); 
//fonction statique n'a pas besoin d'instanciation
PageController::testB(); */

$pageController->home();
