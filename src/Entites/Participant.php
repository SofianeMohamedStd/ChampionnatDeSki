<?php

namespace App\Entites;

use DateTime;
use Exception;
use DateTimeInterface;

class Participant
{
    /**
     * @var int
     */
    private int $Id;

    /**
     * @var string
     */
    private string $Nom;

    /**
     * @var string
     */
    private string $Prenom;

    /**
     * @var string
     */
    private string $Email;

    /**
     * @var int
     */
    private int $CategorieID;

    /**
     * @var int
     */
    private int $ProfilID;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $DateNaissance;

    /**
     * @var string
     */
    private string $Photo;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->Id;
    }

    /**
     * @return string
     */
    public function getNom(): ?string 
    {
        return $this->Nom;
    }

    /**
     * @param $Nom
     * @return Participant
     * @throws Exception
     */
    public function SetNom($Nom): self
    {
        if(! preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",$Nom)){
            throw new Exception('nom invalide');
        }else {
        $this->Nom = $Nom;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): ?string 
    {
        return $this->Prenom;
    }

    /**
     * @param string $Prenom
     * @return Participant
     * @throws Exception
     */
    public function SetPrenom(string $Prenom): self
    {
        if(! preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",$Prenom)){
            throw new Exception('prenom invalide');
        }else
        {
        $this->Prenom = $Prenom;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string 
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     * @throws Exception
     */
    public function SetEmail(string $Email)
    {
        if(! preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$Email))
        {
            throw new Exception('Email invalide');
        }
        $this->Email = $Email;
    }

    /**
     * @return int
     */
    public function getCategorieID(): ?int
    {
        return $this->CategorieID;
    }

    /**
     * @param int $CategorieID
     * @throws Exception
     */
    public function SetCategorieID(int $CategorieID)
    {
        if(! is_int($CategorieID) || ($CategorieID <= 0))
        {
            throw new Exception('Categorie invalide');
        }
        $this->CategorieID = $CategorieID;
    }

    /**
     * @return int
     */
    public function getProfilID(): ?int 
    {
        return $this->ProfilID;
    }

    /**
     * @param int $ProfilID
     * @throws Exception
     */
    public function SetProfilID(int $ProfilID)
    {
        if(! is_int($ProfilID) || ($ProfilID <= 0))
        {
            throw new Exception('Profil invalide');
        }
        $this->ProfilID = $ProfilID;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDateNaissance(): ?DateTimeInterface
    {
        return $this->DateNaissance;
    }

    /**
     * @param string $DateNaissance
     * @return Participant
     * @throws Exception
     */
    public function SetDateNaissance(string $DateNaissance):self
    {
        if (! preg_match("/^(((0[1-9])|(1\d)|(2\d)|(3[0-1]))\/((0[1-9])|(1[0-2]))\/(\d{4}))$/",$DateNaissance))
        {
            throw new Exception('date invalide');
        }else{
        $dateL = DateTime::createFromFormat('d/m/Y', $DateNaissance);
        $this->DateNaissance = $dateL;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto(): ?string 
    {
        return $this->Photo;
    }

    /**
     * @param string $Photo
     * @throws Exception
     */
    public function SetPhoto(string $Photo)
    {
        if(! preg_match("/.*\.(gif|jpe?g|bmp|png)$/",$Photo))
        {
            throw new Exception('photo invalide');
        }
        $this->Photo = $Photo;
    }

}