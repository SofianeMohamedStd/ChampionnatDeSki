<?php
namespace Unity\TestsEntites\Tests;

use Exception;

use App\Entites\Epreuve;
use PHPUnit\Framework\TestCase;
use DateTimeInterface;

beforeEach(function () {
    $this->epreuve = new Epreuve();
});

dataset('LieuEpreuve', ['paris 75000']);
dataset('LieuEpreuveEx', ['paris75000']);
dataset('DateEpreuve',['12/12/2020']);
dataset('DateEpreuveEx',['12/122020']);

it('instance of',function() {
    $this->assertClassHasAttribute('id', Epreuve::class);
    $this->assertClassHasAttribute('Lieu', Epreuve::class);
    $this->assertClassHasAttribute('Date', Epreuve::class);
});

it('has function Existe',function(){
    $this->expect(method_exists ($this->epreuve,'SetLieu'))->toBeTrue();
    $this->expect(method_exists ($this->epreuve,'SetDate'))->toBeTrue();
    $this->expect(method_exists ($this->epreuve,'getDate'))->toBeTrue();
    $this->expect(method_exists ($this->epreuve,'getId'))->toBeTrue();
    });

    it('return getId', function($id){
        $stub = $this->createStub(Epreuve::class);
            $stub->method('getId')
                 ->willReturn($id);
            $this->assertSame($id, $stub->getId());
    })->with('ListId');

it('test Set Lieu', function($Lieu){
    $this->assertMatchesRegularExpression("/^[a-z]* [0-9]{5}$/",$Lieu);
    })->with('LieuEpreuve');

it("Test Exception Set Lieu",function($name) {
    $this->epreuve->SetLieu($name);
    })->with('LieuEpreuveEx')->throws(Exception::class);

    it('should Setlieu return String', function(){
        $this->epreuve->SetLieu('paris 75000');
        $this->expect($this->epreuve->getLieu())->toBeString();
    });

it('test Set Date',function($Date) {
    $this->assertMatchesRegularExpression("/^(((0[1-9])|(1\d)|(2\d)|(3[0-1]))\/((0[1-9])|(1[0-2]))\/(\d{4}))$/",$Date);
    })->with('DateEpreuve');

it('test Exception Set date',function($Date) {
    $this->epreuve->SetDate($Date);
})->with('DateEpreuveEx')->throws(Exception::class);
