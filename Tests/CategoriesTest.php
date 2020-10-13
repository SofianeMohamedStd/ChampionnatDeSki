<?php
namespace Unity\Tests;

use Exception;

use App\Entites\Categorie;
use PHPUnit\Framework\TestCase;

beforeEach(function () {
    $this->categorie = new Categorie();
});
dataset('Categorie', ['senior', 'M1','M1-n']);
dataset('CategorieEx', ['M1 n','M1_','M1/']);

it('instance of',function() {
    $this->assertClassHasAttribute('id', Categorie::class);
    $this->assertClassHasAttribute('NomCategorie', Categorie::class);
});

it('has function Existe',function(){
    $this->expect(method_exists ($this->categorie,'SetNomCategorie'))->toBeTrue();
    });

it('test Set NomCategorie', function($name){
$this->assertMatchesRegularExpression(",^[a-zA-Z0-9[\].-]+$,",$name);
})->with('Categorie');

it("Test Exception Set NomCategorie",function($name) {
    $this->categorie->SetNomCategorie($name);
})->with('CategorieEx')->throws(Exception::class);



