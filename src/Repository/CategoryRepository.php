<?php

namespace App\Repository;

class CategoryRepository extends Repository
{
    public function findAll(): array
    {
        $query = $this->pdo->prepare("SELECT id, name FROM category");
        $query->execute();

        $categories = $query->fetchAll($this->pdo::FETCH_ASSOC);

        return $categories;
    }
}
