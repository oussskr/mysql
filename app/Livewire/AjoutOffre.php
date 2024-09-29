<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;




class AjoutOffre extends Component
{
    public $aoffheaders;
    public $aoffrows;
    public $sortBy;
    public $sortDirection;
    public $showAdd = false;
    public $showFormulaireao = false;
    public $recherche = "";
    public array $selected = [];


    public function mount()



        {
            $this->reload();
        }


        public function reload()
        {

    }
       public function render()
    {
        return view('livewire.ajout-offre');
    }

   



    public function opnformulaireao()
    {
        $this->showFormulaireao = true;
        //dd($this->selected);
    }
    #[On("cancelFormulaireao")]
    public function hideFormulaire()
    {
        $this->showFormulaireao = false;
        $this->redirect("offre");
    }


}
