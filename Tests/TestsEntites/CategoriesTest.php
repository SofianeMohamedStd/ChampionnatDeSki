<?php
namespace Unity\TestsEntites\Tests;

use Exception;

use App\Entites\Categorie;
use PHPUnit\Framework\TestCase;


//dataset('Categorie', ['senior', 'M','Mn']);
//dataset('CategorieEx', ['M1 n','M1_','M1/']);
//dataset('ListId',[1,2,3,4,5]);

it('instance of',function() {
    $this->categorie = new Categorie();
    $this->assertClassHasAttribute('id', Categorie::class);
    $this->assertClassHasAttribute('NomCategorie', Categorie::class);
});

it('has function Existe',function(){
    $this->categorie = new Categorie();
    $this->expect(method_exists ($this->categorie,'setNomCategorie'))->toBeTrue();
    $this->expect(method_exists ($this->categorie,'getNomCategorie'))->toBeTrue();
    $this->expect(method_exists ($this->categorie,'getId'))->toBeTrue();
    });
it('return', function($id){
    $this->categorie = new Categorie();
    $stub = $this->createStub(Categorie::class);
    $stub->method('getId')
    ->willReturn($id);
    $this->assertSame($id, $stub->getId());
    })->with([1,2,3,4,5]);

it('should getNomString return String', function(){
    $this->categorie = new Categorie();
    $this->categorie->setNomCategorie('Sofiane');
    $this->expect($this->categorie->getNomCategorie())->toBeString();
    });

it('test Set NomCategorie', function($name){
    $this->categorie = new Categorie();
    $res = $this->categorie->setNomCategorie($name);
    $this->expect($res->getNomCategorie())->toBeString();
    $this->assertMatchesRegularExpression(",^[a-zA-Z0-9[\].-]+$,",$name);
    })->with(['senior', 'M','Mn']);
        
it("Test Exception Set NomCategorie",function($name) {
    $this->categorie = new Categorie();
    $this->categorie->setNomCategorie($name);
    })->with(['M1 n','M1_','M1/'])->throws(Exception::class);



