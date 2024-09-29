<?php

use App\Livewire\Formulaire;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Formulaire::class)
        ->assertStatus(200);
});
