<?php

namespace App\Factory;

use App\Entites\Passage;

class PassagesFactory
{
    public static function dbCollection(array $DataPassage): object
    {
        $passage = new Passage();
        $passage->buildFromTablePassage($DataPassage);
        return $passage;
    }

    public static function arrayDbCollection(array $DataPassage): array
    {
        $DataPassage =  array_map('self::dbCollection', $DataPassage);
        return $DataPassage;
    }
}
