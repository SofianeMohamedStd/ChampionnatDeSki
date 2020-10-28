<?php

namespace App\Factory;

use App\Entites\Profil;

abstract class ProfilsFactory
{
    public static function dbCollection(array $DataProfil): object
    {
        $profil = new Profil();
        $profil->buildFromTableProfil($DataProfil);
        return $profil;
    }

    public static function arrayDbCollection(array $DataProfil): array
    {
        $DataProfil = array_map('self::dbCollection', $DataProfil);
        return $DataProfil;
    }
}
