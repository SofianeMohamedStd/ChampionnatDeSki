<?php
namespace Unity\TestsEntites\Tests;

use DateTime;

use Exception;
use App\Entites\Passage;
use PHPUnit\Framework\TestCase;


beforeEach(function () {
    $this->passage = new Passage();
});

dataset('NumPassageEx',[-1,0]);
dataset('TimePassage',['01:00.0','99:59.999']);
dataset('TimePassageEx',['01:000']);

it('instance of',function() {
    $this->assertClassHasAttribute('id', Passage::class);
    $this->assertClassHasAttribute('NumPassage',Passage::class);
    $this->assertClassHasAttribute('TempDePassage',Passage::class);
});

it('has Method Existe',function(){
    $this->expect(method_exists ($this->passage,'setNumPassage'))->toBeTrue();
    $this->expect(method_exists ($this->passage,'getNumPassage'))->toBeTrue();
    $this->expect(method_exists ($this->passage,'setTempDePassage'))->toBeTrue();
    $this->expect(method_exists ($this->passage,'getTempDePassage'))->toBeTrue();
    });

it('verified type return must be integer', function($id){
    $stub = $this->createStub(Passage::class);
        $stub->method('getId')
             ->willReturn($id);
        $this->assertSame($id, $stub->getId());
})->with('ListId');

it('verified type & value of number of stage',function($num){
    $this->passage->setNumPassage($num);
})->with('NumPassageEx')->throws(Exception::class);

it('verified type of Time of passage', function($time){
    $timeStage = DateTime::createFromFormat('i:s.u', $time);
    $result = $this->passage->setTempDePassage($time);
    $this->expect($result->getTempDePassage())->toEqual($timeStage);
})->with('TimePassage');

it('test Exception Set Time',function($time) {
    $this->passage->setTempDePassage($time);
})->with('TimePassageEx')->throws(Exception::class);

