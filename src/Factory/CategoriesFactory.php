<?php

namespace App\Factory;

use App\Entites\Categorie;

abstract class CategoriesFactory
{
    public static function dbCollection(array $DataCategorie): object
    {
        $categorie = new Categorie();
        $categorie->buildFromTableCategorie($DataCategorie);

        return $categorie;
    }
    public static function arrayDbCollection(array $DataCategorie): array
    {
        $DataCategorie = array_map('self::dbCollection', $DataCategorie);
        return $DataCategorie;
    }
}
