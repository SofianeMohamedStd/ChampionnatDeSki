<?php
namespace Unity\TestsEntites\Tests;

use Exception;

use App\Entites\Categorie;
use PHPUnit\Framework\TestCase;

beforeEach(function () {
    $this->categorie = new Categorie();
});
dataset('Categorie', ['senior', 'M','Mn']);
dataset('CategorieEx', ['M1 n','M1_','M1/']);
dataset('ListId',[1,2,3,4,5]);

it('instance of',function() {
    $this->assertClassHasAttribute('id', Categorie::class);
    $this->assertClassHasAttribute('NomCategorie', Categorie::class);
});

it('has function Existe',function(){
    $this->expect(method_exists ($this->categorie,'SetNomCategorie'))->toBeTrue();
    $this->expect(method_exists ($this->categorie,'getNomCategorie'))->toBeTrue();
    $this->expect(method_exists ($this->categorie,'getId'))->toBeTrue();
    });
it('return', function($id){
    $stub = $this->createStub(Categorie::class);
    $stub->method('getId')
    ->willReturn($id);
    $this->assertSame($id, $stub->getId());
    })->with('ListId');

it('should getNomString return String', function(){
    $this->categorie->SetNomCategorie('Sofiane');
    $this->expect($this->categorie->getNomCategorie())->toBeString();
    });

it('test Set NomCategorie', function($name){
    $res = $this->categorie->SetNomCategorie($name);
    $this->expect($res->getNomCategorie())->toBeString();
    $this->assertMatchesRegularExpression(",^[a-zA-Z0-9[\].-]+$,",$name);
    })->with('Categorie');
        
it("Test Exception Set NomCategorie",function($name) {
    $this->categorie->SetNomCategorie($name);
    })->with('CategorieEx')->throws(Exception::class);



