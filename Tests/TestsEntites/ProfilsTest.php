<?php
namespace Unity\TestsEntites\Tests;

use Exception;

use App\Entites\Profil;
use PHPUnit\Framework\TestCase;

beforeEach(function () {
    $this->profil = new Profil();
});

dataset('Profil', ['senior', 'M1','M1n']);
dataset('ProfilEx', ['M1 n','M1_']);

it('has function Existe',function(){
    $this->expect(method_exists ($this->profil,'setNomProfil'))->toBeTrue();
    $this->expect(method_exists ($this->profil,'getNomProfil'))->toBeTrue();
    $this->expect(method_exists ($this->profil,'getId'))->toBeTrue();
    });

it('instance of',function() {
    $this->assertClassHasAttribute('id', Profil::class);
    $this->assertClassHasAttribute('NomProfil', Profil::class);
});

it('test Set NomProfil', function($name){
$this->assertMatchesRegularExpression(",^[a-zA-Z0-9[\].-:]+$,",$name);
})->with('Profil');

it("Test Exception Set NomProfil",function($name) {
    $this->profil->setNomProfil($name);
})->with('ProfilEx')->throws(Exception::class);

it('should SetNomProfil return String', function(){
    $this->profil->setNomProfil('sofiane');
    $this->expect($this->profil->getNomProfil())->toBeString();
});