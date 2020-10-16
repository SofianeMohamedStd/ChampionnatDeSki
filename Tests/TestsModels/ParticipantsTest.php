<?php
namespace Unity\TestsModels\Tests;

use App\Models\Participants;
use PHPUnit\Framework\TestCase;

beforeEach(function () {
    $this->participantsM = new Participants();
});

it('test of instance and all Methodes exist in Model participants', function(){
    $this->expect($this->participantsM)->toBeInstanceOf(Participants::class);
    $this->expect(method_exists ($this->participantsM,  'AddParticipant' ))->toBeTrue();
    $this->expect(method_exists ($this->participantsM,  'UpDateParticipant' ))->toBeTrue();
    $this->expect(method_exists ($this->participantsM,  'DeleteParticipant' ))->toBeTrue();
    $this->expect(method_exists ($this->participantsM,  'GetAllParticipants' ))->toBeTrue();
    $this->expect(method_exists ($this->participantsM,  'GetOneParticipant' ))->toBeTrue();
    });