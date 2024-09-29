<?php

use App\Livewire\DashBoaqrdOffers;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(DashBoaqrdOffers::class)
        ->assertStatus(200);
});
