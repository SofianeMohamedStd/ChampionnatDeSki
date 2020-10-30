<?php

namespace App\Entites;

use DateTime;
use DateTimeInterface;

class Passage
{
    private int $id;

    private int $idParticipant;

    private $time1;

    private $time2;




    public function getid(): ?int
    {
        return $this->id;
    }

    public function setid($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getidParticipant(): ?int
    {
        return $this->idParticipant;
    }

    public function setidParticipant($id): self
    {
        $this->idParticipant = $id;
        return $this;
    }

    public function getTime1()
    {
        return $this->time1;
    }

    public function setTime1(string $timeStage): self
    {

        $this->time1 = $timeStage;
        return $this;
    }

    public function getTime2()
    {
        return $this->time2;
    }

    public function setTime2(string $timeStage): self
    {

        $this->time2 = $timeStage;

        return $this;
    }
    public function buildFromTablePassage(array $Datapassage): self
    {
        $this->id = $Datapassage['id'];
        $this->idParticipant = $Datapassage['participants_id'];
        $this->time1 =  $Datapassage['temps_passage_1'];
        $this->time2 =  $Datapassage['temps_passage_2'];

        return $this;
    }
}
