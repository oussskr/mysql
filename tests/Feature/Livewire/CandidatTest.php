<?php

use App\Livewire\Candidat;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Candidat::class)
        ->assertStatus(200);
});
