<?php

use App\Livewire\PersonalAdd;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(PersonalAdd::class)
        ->assertStatus(200);
});
