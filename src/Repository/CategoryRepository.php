<?php

namespace App\Repository;

use App\Entity\Category;

class CategoryRepository extends Repository
{
    public function findAll(): array
    {
        $query = $this->pdo->prepare("SELECT id, name FROM category");
        $query->execute();

        // Hydratation automatique par PDO avec FETCH_CLASS (il delivre un des objets)-> plus pratique pour manipuler que FETCH_ASSOC (il delivre un tableau associatif), mais il marche avec des contenu simple (Ex: ne marche pas avec Datetime)
        //$categories = $query->fetchAll($this->pdo::FETCH_CLASS, Category::class);

        $categories = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $categoriesArray = [];
        if ($categories) {
            foreach ($categories as $categoryArray) {
                $categoriesArray[] = Category::createAndHydrate($categoryArray);
            }
        }
        return $categoriesArray;
    }

    public function findById(int $id): Category
    {
        $query = $this->pdo->prepare("SELECT id, name FROM category WHERE id = :id");
        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->execute();

        $categoryArray = $query->fetch($this->pdo::FETCH_ASSOC);

        $category = Category::createAndHydrate($categoryArray);

        return $category;
    }
}
