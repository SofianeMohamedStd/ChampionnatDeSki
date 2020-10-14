<?php

namespace App\Entites;

use DateTime;
use Exception;
use DateTimeInterface;


class Epreuve 
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $Lieu;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $Date;

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLieu():string 
    {
        return $this->Lieu;
    }

    /**
     * @param string $Lieu
     * @return void
     * @throws Exception
     */
    public function SetLieu(string $Lieu)
    {
        if(! preg_match("/^[a-z]* [0-9]{5}$/", $Lieu))
        {
            throw new Exception('Lieu invalide');
        }
        $this->Lieu = $Lieu;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate():DateTimeInterface
    {
        return $this->Date;
    }

    /**
     * @param String $Date
     * @throws Exception
     */
    public function SetDate(String $Date)
    {
        if (! preg_match("/^(((0[1-9])|(1\d)|(2\d)|(3[0-1]))\/((0[1-9])|(1[0-2]))\/(\d{4}))$/",$Date))
        {
            throw new Exception('date invalide');
        }
        $dateL = DateTime::createFromFormat('d/m/Y', $Date);
        $this->Date = $dateL;
    }
}