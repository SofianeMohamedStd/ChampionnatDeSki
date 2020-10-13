<?php

namespace App\Entites;

use DateTime;
use Exception;
use DateTimeInterface;


class Epreuve 
{
    private int $id;
    private string $Lieu;
    private DateTimeInterface $Date;
   
    public function getId():int
    {
        return $this->id;
    }

    public function getLieu():string 
    {
        return $this->Lieu;
    }

    public function SetLieu(string $Lieu)
    {
        if(! preg_match('#[0-9]+ rue de [a-z]+ [a-z]+ [0-9]{5}#i', $Lieu))
        {
            throw new Exception('Lieu invalide');
        }
        $this->Lieu = $Lieu;
    }

    public function getDate():DateTimeInterface
    {
        return $this->Date;
    }

    public function SetDate(String $Date)
    {
        if (! preg_match('^(((0[1-9])|(1\d)|(2\d)|(3[0-1]))\/((0[1-9])|(1[0-2]))\/(\d{4}))$',$Date))
        {
            throw new Exception('date invalide');
        }
        $dateL = DateTime::createFromFormat('d/m/Y', $Date);
        $this->Date = $dateL;
    }
}