<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Demandes extends Component
{
    public $demheaders;
    public $demrows;
    public $sortBy;
    public $sortDirection;
    public $showAdd = false;

    public function mount()
    {

    }
    public function loadData()
    {
       
    }
    public function render()
    {
        return view('livewire.demandes');
    }


    public function sortBy($field)
    {
        // $this->sortBy = $field;
        // $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function setShowAdd()
    {
        //$this->showAdd = true;
    }
    // #[On("cancel")]
    public function hideAdd()
    {
        //$this->showAdd = false;
    }
}
