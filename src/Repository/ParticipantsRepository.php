<?php


namespace App\Repository;


use App\Entites\Participant;

interface ParticipantsRepository
{
    public function AddParticipant(Participant $participant);
    public function UpDateParticipant(Participant $participant);
    public function DeleteParticipant(Participant $participant);
    public function GetAllParticipants(): array;
    public function GetOneParticipant(Participant $participant):array;
}