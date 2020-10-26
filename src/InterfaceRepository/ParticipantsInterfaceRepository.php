<?php

namespace App\Repository;

use App\Entites\Participant;

interface ParticipantsRepository
{
    public function addParticipant(Participant $participant);
    public function upDateParticipant(Participant $participant);
    public function deleteParticipant(Participant $participant);
    public function getAllParticipants(): array;
    public function getOneParticipant(Participant $participant): array;
}
