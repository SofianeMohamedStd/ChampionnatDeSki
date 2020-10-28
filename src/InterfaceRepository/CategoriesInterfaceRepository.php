<?php

namespace App\InterfaceRepository;

use App\Entites\Categorie;

interface CategoriesInterfaceRepository
{
    public function add(Categorie $categorie);
    public function findAll(): array;
    public function find(int $categorie);
    public function findbyName(Categorie $categorie): array;
}
