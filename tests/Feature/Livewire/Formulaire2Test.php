<?php

use App\Livewire\Formulaire2;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Formulaire2::class)
        ->assertStatus(200);
});
