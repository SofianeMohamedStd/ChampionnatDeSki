<?php
namespace Unity\TestsModels\Tests;

use App\Models\ParticipantsRepository;
use PHPUnit\Framework\TestCase;

beforeEach(function () {
    $this->participantsM = new ParticipantsRepository();
});

it('test of instance and all Methodes exist in Model participants', function(){
    $this->expect($this->participantsM)->toBeInstanceOf(ParticipantsRepository::class);
    $this->expect(method_exists ($this->participantsM,  'addParticipant' ))->toBeTrue();
    $this->expect(method_exists ($this->participantsM,  'upDateParticipant' ))->toBeTrue();
    $this->expect(method_exists ($this->participantsM,  'deleteParticipant' ))->toBeTrue();
    $this->expect(method_exists ($this->participantsM,  'getAllParticipants' ))->toBeTrue();
    $this->expect(method_exists ($this->participantsM,  'getOneParticipant' ))->toBeTrue();
    });