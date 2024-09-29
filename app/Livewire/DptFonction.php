<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class DptFonction extends Component
{
    public $dptheaders = [];
    public $dpt = [];
    public $fonheaders = [];
    public $fon = [];

    public $sortBy;
    public $sortDirection;

    public $recherche = "";
    public $showAdd = false;

    public $showFormulairefon = false;
    public $showFormulairedpt = false;

    public $selectedItem = null;
    public $confirmingDelete = false;
    public $confirmingModify = false;

    public function mount()
    {
        $this->reload();
    }

    public function reload()
    {
        $this->dptheaders = [
            ['key' => 'structure_id', 'label' => 'id', 'class' => 'w-16'],
            ['key' => 'structure_designation', 'label' => 'designation', 'class' => 'w-72'],
        ];

        $this->dpt = DB::select("SELECT structure_id, structure_designation FROM structure WHERE structure_designation LIKE '%$this->recherche%';");

        $this->fonheaders = [
            ['key' => 'fonction_id', 'label' => 'id', 'class' => 'w-16'],
            ['key' => 'fonction_nom', 'label' => 'designation', 'class' => 'w-72'],
        ];

        $this->fon = DB::select("SELECT fonction_id, fonction_nom FROM fonction WHERE fonction_nom LIKE '%$this->recherche%';");
    }

    public function render()
    {
        return view('livewire.dpt-fonction');
    }

    public function setShowAdd()
    {
        //$this->showAdd = true;
    }

    public function sortBy($field)
    {
        $this->sortBy = $field;
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function opnformulairefon()
    {
        $this->showFormulairefon = true;
    }

    #[On("cancelFormulairefon")]
    public function hideFormulairefon()
    {
        $this->showFormulairefon = false;
    }

    public function opnformulairedpt()
    {
        $this->showFormulairedpt = true;
    }

    #[On("cancelFormulairedpt")]
    public function hideFormulairedpt()
    {
        $this->showFormulairedpt = false;
    }

    public function confirmDelete($item)
    {
        $this->selectedItem = $item;
        $this->confirmingDelete = true;
    }

    public function deleteItem()
    {
        // Logic to delete item
        $this->confirmingDelete = false;
        // You need to implement your own logic here to delete the selected item
    }

    public function confirmModify($item)
    {
        $this->selectedItem = $item;
        $this->confirmingModify = true;
    }

    public function modifyItem()
    {
        // Logic to modify item
        $this->confirmingModify = false;
        // You need to implement your own logic here to modify the selected item
    }
}
