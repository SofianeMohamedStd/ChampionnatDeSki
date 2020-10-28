<?php

namespace App\InterfaceRepository;

use App\Entites\Participant;

interface ParticipantsInterfaceRepository
{
    public function addParticipant(Participant $participant);
    public function upDateParticipant(Participant $participant);
    public function deleteParticipant(Participant $participant);
    public function getAllParticipants(): array;
    public function getOneParticipant(Participant $participant): array;
    public function getInfoParticipantForCSV(): array;
    public function addPassage(Participant $passage): bool;
}
