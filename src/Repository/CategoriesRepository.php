<?php


namespace App\Repository;


use App\Entites\Categorie;

interface CategoriesRepository
{
public function Add(Categorie $categorie);
    public function findAll():array;
public function find(int $categorie);

}