<?php

use App\Livewire\Demandes;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Demandes::class)
        ->assertStatus(200);
});
