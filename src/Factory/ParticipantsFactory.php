<?php

namespace App\Factory;

use App\Entites\Participant;

abstract class ParticipantsFactory
{
    public static function dbCollection(array $DataParticipant): object
    {
        $participant = new Participant();
        $participant -> buildFromTableParticipant($DataParticipant);

        return $participant;
    }
    public static function dbCollectionForCSV(array $DataParticipant): object
    {
        $participant = new Participant();
        $participant -> buildFromTableParticipantForCSV($DataParticipant);

        return $participant;
    }


    public static function arrayDbCollection(array $DataParticipant): array
    {
        $DataParticipant = array_map('self::dbCollection', $DataParticipant);

        return $DataParticipant;
    }

    public static function arrayDbCollectionForCSV(array $DataParticipant): array
    {
        $DataParticipant = array_map('self::dbCollectionForCSV', $DataParticipant);

        return $DataParticipant;
    }
}
