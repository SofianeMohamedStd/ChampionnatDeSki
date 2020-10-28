<?php

namespace App\Factory;

use App\Entites\Epreuve;

abstract class EpreuvesFactory
{
    public static function dbCollection(array $DataEpreuve): object
    {
        $epreuve = new Epreuve();
        $epreuve->buildFromTableEpreuve($DataEpreuve);
        return $epreuve;
    }

    public static function dbCollectionCSV(array $DataParticipant): object
    {
        $epreuve = new Epreuve();
        $epreuve->buildTableParticipantForCSV($DataParticipant);
        return $epreuve;
    }

    public static function arrayDbCollectionCSV(array $DataParticipant): array
    {
        $DataParticipant = array_map('self::dbCollectionCSV', $DataParticipant);
        return $DataParticipant;
    }

    public static function arrayDbCollection(array $DataEpreuve): array
    {
        $DataEpreuve = array_map('self::dbCollection', $DataEpreuve);
        return $DataEpreuve;
    }
}
