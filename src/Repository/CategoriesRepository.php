<?php

namespace App\Repository;

use App\Entites\Categorie;

interface CategoriesRepository
{
    public function add(Categorie $categorie);
    public function findAll(): array;
    public function find(int $categorie);
}
