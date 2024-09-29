<?php

namespace App\Livewire;

use Livewire\Component;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\On;

use Mary\Traits\Toast;

class Formulairetraitercandidature extends Component
{

    
    public $save = true ; 
    public $entretien_lieu = "" ;
    public $entretien_type = "" ;
    public Carbon $entretien_date ;


    use Toast;
public function  opnFormulairetraitercandidature (){
    $this->dispatchBrowserEvent('opnFormulairetraitercandidature', ['url' => '/Formulairetraitercandidature']);

}


   public function mount()
    {
        
    }

    public ?int $candidature_id = null;
    public $candidature = null ; 
    public $action = null ; 
    
    #[On('setCandidature')]
    public function setCandidature($id , $action)
    {
        $this->action = $action ; 
        $this->candidature_id = $id;
        $this->candidature = DB::selectOne("SELECT 
                        c.* , 
                        br.structure_id
                    FROM candidat c
                    Left join offre o on o.offre_id = c.offre_id
                    left join besoin_recrutment br on br.besoin_recrutment_id = o.besoin_recrutment_id
                    where c.candidat_id= $id");
       
       
    }
    public function postuler()
     {
        if($this->action == 'Rejeter') {
            DB::table('candidat')->where("candidat_id" , $this->candidature_id )->update([ 'demande_recrutment_statut' => 'Rejetée' , ]);
            $this->candidature = null ; 
            $this->action = null ; 
            $this->success("l'candidature a etait bloqué avec success");
            $this->dispatch('cancelFormulairetraitercandidature');
        }else if ($this->action == 'Valider' || $this->action == 'Changer') {
            DB::table('entretient')->insert([
                'entretien_date' => $this->entretien_date ,  
                'entretien_lieu' => $this->entretien_lieu ,  
                'entretien_type' => $this->entretien_type , 
                'candidat_id' => $this->candidature->candidat_id, 
                'structure_id' => $this->candidature->structure_id, 
            ]); 
            
            DB::table('candidat')->where("candidat_id" , $this->candidature_id )->update([ 'demande_recrutment_statut' => 'Acceptée' , ]);
            $this->entretien_date  ; 
            $this->entretien_type =  "" ;  
            $this->entretien_lieu =  "" ; 
            $this->candidature = null ; 
            $this->action = null ; 
            $this->success("l'entretient a etait pris avec success");
            $this->dispatch('cancelFormulairetraitercandidature');
        }else {
            
        }
   }
    public function render()
    {
        return view('livewire.formulairetraitercandidature');
    }
}
