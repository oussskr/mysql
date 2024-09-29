<?php

use App\Livewire\ProgramerUnEntretient;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ProgramerUnEntretient::class)
        ->assertStatus(200);
});
