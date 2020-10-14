<?php
namespace Unity\TestsEntites\Tests;

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
    $this->expect(method_exists ($this->participant,'SetNom'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'SetPrenom'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'SetEmail'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'SetCategorieID'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'SetProfilID'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'SetDateNaissance'))->toBeTrue();
    $this->expect(method_exists ($this->participant,'SetPhoto'))->toBeTrue();
    });

it('test Set Nom', function($name){
    $this->assertMatchesRegularExpression("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",$name);
    })->with('Nom');

it("Test Exception Set Nom",function($name) {
        $this->participant->SetNom($name);
    })->with('NomEx')->throws(Exception::class);

it('test Set Prenom', function($prenom){
    $this->assertMatchesRegularExpression("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",$prenom);
    })->with('Nom');
    
it("Test Exception Set Prenom",function($prenom) {
    $this->participant->SetNom($prenom);
    })->with('NomEx')->throws(Exception::class);

it('test Set Email', function($email){
        $this->assertMatchesRegularExpression("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$email);
        })->with('Email');
        
it("Test Exception Set Email",function($email) {
        $this->participant->SetNom($email);
        })->with('EmailEx')->throws(Exception::class);

it('test Set Categorie', function($categorie){
        $this->expect($categorie)->toBeInt();
        $this->expect($categorie)->toBeGreaterThan(0);
        })->with('CategorieId');
            
it("Test Exception Set Categorie",function($categorie) {
        $this->participant->SetCategorieID($categorie);
        })->with('CategrieExId')->throws(Exception::class);

it('test Set Profil', function($profil){
        $this->expect($profil)->toBeInt();
        $this->expect($profil)->toBeGreaterThan(0);
        })->with('CategorieId');
                
it("Test Exception Set Profil",function($profil) {
        $this->participant->SetProfilID($profil);
        })->with('CategrieExId')->throws(Exception::class);

it('test Set Date',function($Date) {
        $this->assertMatchesRegularExpression("/^(((0[1-9])|(1\d)|(2\d)|(3[0-1]))\/((0[1-9])|(1[0-2]))\/(\d{4}))$/",$Date);
        })->with('Date');
        
it('test Exception Set date',function($Date) {
        $this->participant->SetDateNaissance($Date);
        })->with('DateEx')->throws(Exception::class);

        it('test Set Photo',function($Photo) {
            $this->assertMatchesRegularExpression("/.*\.(gif|jpe?g|bmp|png)$/",$Photo);
            })->with('Photo');
            
    it('test Exception Set Photo',function($Photo) {
            $this->participant->SetPhoto($Photo);
            })->with('PhotoEx')->throws(Exception::class);

