<?php

namespace App\Entites;

use DateTime;
use DateTimeInterface;

class Passage
{
    private int $id;

    private int $idParticipant;

    private ?DateTimeInterface $time1;

    private ?DateTimeInterface $time2;

    private ?DateTimeInterface $moyenne;



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

    public function getTime1(): ?DateTimeInterface
    {
        return $this->time1;
    }

    public function setTime1(string $timeStage): self
    {
        $time = DateTime::createFromFormat('H:i:s.u', $timeStage);
        $this->time1 = $time;

        return $this;
    }

    public function getTime2(): ?DateTimeInterface
    {
        return $this->time2;
    }

    public function setTime2(string $timeStage): self
    {
        $time = DateTime::createFromFormat('H:i:s.u', $timeStage);
        $this->time2 = $time;

        return $this;
    }

    public function getResultat(): ?DateTimeInterface
    {
        return $this->moyenne;
    }

    public function setResultat(): self
    {
        $moyenne = ($this->getTime1() + $this->getTime2());
        $time = DateTime::createFromFormat('H:i:s.u', $moyenne);
        $this->moyenne = $moyenne;

        return $this;
    }
}
