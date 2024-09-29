<?php

namespace App\Livewire;

use Livewire\Component;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\On;

use Mary\Traits\Toast;

class Formulaireoffrebloque extends Component
{

    public $save = true ;
    use Toast;
public function  opnFormulaireoffrebloque (){
    $this->dispatchBrowserEvent('opnFormulaireoffrebloque', ['url' => '/Formulaireoffrebloque']);

}


   public function mount()
    {

    }

    public ?int $offre_id = null;
    public $offre = null ;
    #[On('setOffre')]
    public function setOffre($id)
    {

        $this->offre_id = $id;
        $this->offre = DB::selectOne("SELECT
                        o.*
                    FROM offre o
                    where o.offre_id= $id");


    }
    public function postuler()
     {
        DB::table('offre')->where("offre_id" , $this->offre_id )->update([ 'bloque' => $this->offre->bloque == 1 ? 0 : 1 , ]);
        $this->offre = null ;
        $this->success("l'offre a etait bloqué avec success");
        $this->dispatch('cancelFormulaireoffrebloque');
   }
    public function render()
    {
        return view('livewire.formulaireoffrebloque');
    }
}
