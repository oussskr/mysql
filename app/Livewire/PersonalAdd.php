<?php

namespace App\Livewire;

use Livewire\Component;

class PersonalAdd extends Component
{

    public $name = "salah eddine";
    public function save()
    {
        dd($this->name);
    }
    public function render()
    {
        return view('livewire.personal-add');
    }
}
