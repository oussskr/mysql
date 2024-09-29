<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Diplome extends Component
{




    public $diplomeheaders=[];
    public $diplome =[];
    public $recherche = "";
    public $showAdd = false;

    public $sortBy;
    public $sortDirection;

public $showFormulairedip = false;

    public function mount()
    {
        $this->reload();
    }
    public function reload()
    {
        $this->diplomeheaders = [
            ['key' => 'diplome_id', 'label' => 'id', 'class' => 'w-16'],
            ['key' => 'diplome_designation', 'label' => 'Diplômes', 'class' => 'w-72'],

            ];
            $this->diplome = DB::select("SELECT
                                    diplome_id ,
                                diplome_designation
                                from diplome
                                    where diplome_designation like '%$this->recherche%';");
    }
   
    public function setShowAdd()
    {
        //$this->showAdd = true;
    }
 
    public function render()
    {
        return view('livewire.diplome');
    }




    public function sortBy($field)
{
    $this->sortBy = $field;
    $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
}

public function opnformulairefon()
{
    $this->showFormulairedip = true;
    //dd($this->selected);
}


#[On("cancelFormulairedip")]
public function hideFormulairedip()
{
    $this->showFormulairedip = false;
}


}
