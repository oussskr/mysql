<?php

namespace App\Livewire;

use Livewire\Component;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\On;

use Mary\Traits\Toast;

class Formulaireao extends Component
{
    use Toast;
public function  opnformulaireao (){
    $this->dispatchBrowserEvent('opnformulaireao', ['url' => '/formulaireao']);

}
public string $offre_titre = '';

    public string $offre_nbr_postes = '';
    public string $niveau_etude = '';
    public string $offre_description = '';
    public Carbon $offre_date_limit_condidature ;
    public string $offre_lieu = '';
    public string $offre_competences_requises = '';
    public string $offre_type_contrat = '';
    public string $besoin_recrutment = '';

    public  $contrats_db = [];
    public  $contrats = [];
    public  $wilayas_db = [];
    public  $wilayas = [];
    public  $besoins_db = [];
    public  $besoins = [];

    public function loadData()
    {
        $this->contrats_db = DB::select("SELECT type_contrat_id as id , type_contrat_nom as name FROM type_contrat ");
        $this->wilayas_db = DB::select("SELECT wilaya_id as id , wilaya_designation as name FROM wilaya ");
        $this->besoins_db = DB::select("SELECT b.besoin_recrutment_id as id , CONCAT( b.besoin_recrutment_titre_offre , ' - ' , s.structure_designation ) as name
                                            FROM besoin_recrutment b
                                            LEFT JOIN structure s on s.structure_id = b.structure_id
                                        ");
        $this->contrats = $this->contrats_db  ;
        $this->wilayas  = $this->wilayas_db  ;
        $this->besoins  = $this->besoins_db  ;
    }

    public function searchContract(string $value = '') {
        $this->contrats = array_filter($this->contrats_db ,function($element) use ($value) {
            return strpos(strtolower($element->name), strtolower($value)) !== false   ;
        } ) ;
    }
    public function searchWilaya(string $value = '') {
        $this->wilayas = array_filter($this->wilayas_db ,function($element) use ($value) {
            return strpos(strtolower($element->name), strtolower($value)) !== false   ;
        } ) ;
    }
    public function searchBesoin(string $value = '') {
        $this->besoins = array_filter($this->besoins_db ,function($element) use ($value) {
            return strpos(strtolower($element->name), strtolower($value)) !== false   ;
        } ) ;
    }




   public function mount()
    {
        $this->loadData() ;
    }

    
    public function postuler()
     {
        // dd($this->nom);
        $check =  DB::table('offre')->where([
             'offre_titre' => $this->offre_titre,
            'offre_date_limit_condidature' => $this->offre_date_limit_condidature,
        ])->first();
        if($check != null)
        {
            $this->error('votre offre a etait deja sumit avec success');
            return;
      }
        DB::table('offre')->insert([
            'offre_titre' => $this->offre_titre,
            'offre_date_limit_condidature' => $this->offre_date_limit_condidature,
            'offre_nbr_postes' => $this->offre_nbr_postes,
            'niveau_etude' => $this->niveau_etude,
            'offre_description' => $this->offre_description,
            'offre_lieu' => $this->offre_lieu,
            'offre_competences_requises' => $this->offre_competences_requises,
            'offre_type_contrat' => $this->offre_type_contrat,
            'besoin_recrutment_id' => $this->besoin_recrutment,

        ]);
        $this->success('votre offre a etait sumit avec success');

        $this->dispatch('cancelFormulaireao');
   }
    public function render()
    {
        return view('livewire.formulaireao');
    }
}
