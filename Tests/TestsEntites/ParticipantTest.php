<?php
namespace Unity\TestsEntites\Tests;

use DateTime;

use Exception;
use App\Entites\Participant;
use PHPUnit\Framework\TestCase;

beforeEach(function () {
    $this->participant = new Participant();
});

it('instance of',function() {
    $this->assertClassHasAttribute('Id', Participant::class);
    $this->assertClassHasAttribute('Nom', Participant::class);
    $this->assertClassHasAttribute('Prenom', Participant::class);
    $this->assertClassHasAttribute('Email', Participant::class);
    $this->assertClassHasAttribute('CategorieID', Participant::class);
    $this->assertClassHasAttribute('ProfilID', Participant::class);
    $this->assertClassHasAttribute('DateNaissance', Participant::class);
    $this->assertClassHasAttribute('Photo', Participant::class);
});

dataset('Nom', ['sofiane', 'mohamed-sofiane']);
dataset('NomEx', ['sofiane_']);
dataset('Email', ['contact@exemple.com']);
dataset('EmailEx', ['contact@exemplecom']);
dataset('CategorieId', [1,28]);
dataset('CategrieExId', [-1,0]);
dataset('Date',['12/12/2020']);
dataset('DateEx',['12/122020']);
dataset('Photo',['img.jpg']);
dataset('PhotoEx',['imgjpg']);

it('has function Existe',function(){
    $this->expect(method_exists ($this->participant,'setNom'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'setPrenom'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'setEmail'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'setCategorieID'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'setProfilID'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'setDateNaissance'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'setPhoto'))->toBeTrue();
    });

it('test Set Nom', function($name){
        $res = $this->participant->setNom($name);
        $this->expect($res->getNom())->toBeString();
    $this->assertMatchesRegularExpression("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",$name);
    })->with('Nom');

    it('should SetNom return String', function(){
        $this->participant->setNom('sofiane');
        $this->expect($this->participant->getNom())->toBeString();
    });

it('test Set Prenom', function($prenom){
        $res = $this->participant->setPrenom($prenom);
        $this->expect($res->getPrenom())->toBeString();
    $this->assertMatchesRegularExpression("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",$prenom);
    })->with('Nom');

    it('should SetPrenom return String', function(){
        $this->participant->setPrenom('sofiane');
        $this->expect($this->participant->getPrenom())->toBeString();
    });

it("Test Exception Set Prenom",function($prenom) {
    $this->participant->setNom($prenom);
    })->with('NomEx')->throws(Exception::class);

it('test Set Email', function($email){
        $this->assertMatchesRegularExpression("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$email);
        })->with('Email');

it('should SetEmail return String', function(){
        $this->participant->setEmail('sofiane@gmail.com');
        $this->expect($this->participant->getEmail())->toBeString();
            });
        
it("Test Exception Set Email",function($email) {
        $this->participant->setNom($email);
        })->with('EmailEx')->throws(Exception::class);

it('test Set Categorie', function($categorie){
        $this->expect($categorie)->toBeInt();
        $this->expect($categorie)->toBeGreaterThan(0);
        })->with('CategorieId');
            
it("Test Exception Set Categorie",function($categorie) {
        $this->participant->setCategorieID($categorie);
        })->with('CategrieExId')->throws(Exception::class);

it('should SetCategorieID return String', function(){
        $this->participant->setCategorieID(1);
        $this->expect($this->participant->getCategorieID())->toBeInt();
        });

it('test Set Profil', function($profil){
        $this->expect($profil)->toBeInt();
        $this->expect($profil)->toBeGreaterThan(0);
        })->with('CategorieId');

it('should SetProfilID return String', function(){
        $this->participant->setProfilID(1);
        $this->expect($this->participant->getProfilID())->toBeInt();
        });

it("Test Exception Set Profil",function($profil) {
        $this->participant->setProfilID($profil);
        })->with('CategrieExId')->throws(Exception::class);

it('test Set Date',function($Date) {
        $timeStage = DateTime::createFromFormat('d/m/Y', $Date);
        $result = $this->participant->setDateNaissance($Date);
        $this->expect($result->getDateNaissance())->toEqual($timeStage);
        $this->assertMatchesRegularExpression("/^(((0[1-9])|(1\d)|(2\d)|(3[0-1]))\/((0[1-9])|(1[0-2]))\/(\d{4}))$/",$Date);
        })->with('Date');
        
it('test Exception Set date',function($Date) {
        $this->participant->setDateNaissance($Date);
        })->with('DateEx')->throws(Exception::class);

it('test Set Photo',function($Photo) {
        $this->assertMatchesRegularExpression("/.*\.(gif|jpe?g|bmp|png)$/",$Photo);
        })->with('Photo');

it('should SetPhoto return String', function(){
        $this->participant->setPhoto('img.png');
        $this->expect($this->participant->getPhoto())->toBeString();
        });

it('test Exception Set Photo',function($Photo) {
        $this->participant->setPhoto($Photo);
        })->with('PhotoEx')->throws(Exception::class);

