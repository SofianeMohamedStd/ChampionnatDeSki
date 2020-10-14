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
    $this->expect(method_exists ($this->profil,'SetNomProfil'))->toBeTrue();
    });

it('instance of',function() {
    $this->assertClassHasAttribute('id', Profil::class);
    $this->assertClassHasAttribute('NomProfil', Profil::class);
});

it('test Set NomProfil', function($name){
$this->assertMatchesRegularExpression(",^[a-zA-Z0-9[\].-:]+$,",$name);
})->with('Profil');

it("Test Exception Set NomProfil",function($name) {
    $this->profil->SetNomProfil($name);
})->with('ProfilEx')->throws(Exception::class);