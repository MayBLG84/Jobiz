<?php

namespace App\Controller; // namespace sert pour éviter la colision de nom (ex: une classe d'un bundle x une classe que l'on a crée)

class PageController extends Controller
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

    public function test(): void
    {
        $this->render("page/test");
    }
}
