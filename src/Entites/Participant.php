<?php

namespace App\Entites;

use DateTime;
use Exception;
use DateTimeInterface;

class Participant
{
    private int $Id;
    private string $Nom;
    private string $Prenom;
    private string $Email;
    private int $CategorieID;
    private int $ProfilID;
    private DateTimeInterface $DateNaissance;
    private string $Photo;

    public function getId():int
    {
        return $this->Id;
    }

    public function getNom():string 
    {
        return $this->Nom;
    }

    public function SetNom($Nom)
    {
        if(! preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",$Nom)){
            throw new Exception('nom invalide');
        }
        $this->Nom = $Nom;
    }

    public function getPrenom():string 
    {
        return $this->Prenom;
    }

    public function SetPrenom(string $Prenom)
    {
        if(! preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",$Prenom)){
            throw new Exception('prenom invalide');
        }
        $this->Prenom = $Prenom;
    }

    public function getEmail():string 
    {
        return $this->Email;
    }

    public function SetEmail(string $Email)
    {
        if(! preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$Email))
        {
            throw new Exception('Email invalide');
        }
        $this->Email = $Email;
    }
    
    public function getCategorieID():int
    {
        return $this->CategorieID;
    }
    
    public function SetCategorieID(int $CategorieID)
    {
        if(! is_int($CategorieID) || ($CategorieID <= 0))
        {
            throw new Exception('Categorie invalide');
        }
        $this->CategorieID = $CategorieID;
    }

    public function getProfilID():int 
    {
        return $this->ProfilID;
    }

    public function SetProfilID(int $ProfilID)
    {
        if(! is_int($ProfilID) || ($ProfilID <= 0))
        {
            throw new Exception('Profil invalide');
        }
        $this->ProfilID = $ProfilID;
    }

    public function getDateNaissance(): DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function SetDateNaissance(string $DateNaissance)
    {
        if (! preg_match('^(((0[1-9])|(1\d)|(2\d)|(3[0-1]))\/((0[1-9])|(1[0-2]))\/(\d{4}))$',$DateNaissance))
        {
            throw new Exception('date invalide');
        }
        $dateL = DateTime::createFromFormat('d/m/Y', $DateNaissance);
        $this->DateNaissance = $dateL;
    }

    public function getPhoto():string 
    {
        return $this->Photo;
    }

    public function SetPhoto(string $Photo)
    {
        if(! preg_match("/.*\.(gif|jpe?g|bmp|png)$/",$Photo))
        {
            throw new Exception('photo invalide');
        }
        $this->Photo = $Photo;
    }

}