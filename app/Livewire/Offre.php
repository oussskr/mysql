<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;




class Offre extends Component
{
    public $offheaders;
    public $offrows;
    public $sortBy;
    public $sortDirection;
    public $showAdd = false;
    public $showFormulaireao  = false;
    public array $selected = [];
    public $recherche = "";
    public $index = 0;
    public $offset = 10;
    public $total = 0 ;



    public function mount()



        {
            $this->reload();
        }


        public function reload()
        {
        $this->offheaders = [
            ['key' => 'row_index', 'label' => 'index', 'class' => 'w-16'],
            ['key' => 'structure_designation', 'label' => 'Structure', 'class' => 'w-72'],
            ['key' => 'besoin_recrutment_titre_offre', 'label' => 'Besoin', 'class' => 'w-72'],
            ['key' => 'offre_titre', 'label' => 'Titre', 'class' => 'w-full'],

            ['key' => 'offre_nbr_postes', 'label' => 'Nbr postes', 'class' => 'w-40'],
            ['key' => 'offre_nbr_candidature', 'label' => 'Nbr Candidatures', 'class' => 'w-40'],

            ['key' => 'type_contrat_nom', 'label' => 'Type contrat', 'class' => 'w-40'],
            ['key' => 'offre_date_limit_condidature', 'label' => 'Date limit', 'class' => 'w-100'],
            ['key' => 'expire', 'label' => 'Expiré ?'],
            ['key' => 'bloque', 'label' => 'Bloqué ?'],

        ];
        $this->loadData();


    }
    public function setIndex($i) {
        if($this->total > count($this->offrows)) {
            $this->index = $i -1 ;
            $this->loadData() ;
        }
    }


    public function afficher() {
        $this->index = 0 ;
        $this->loadData() ;
    }
    public function loadData()
    {
        $this->total = DB::select("SELECT count(*) as total
            from offre o
            LEFT JOIN besoin_recrutment br ON br.besoin_recrutment_id = o.besoin_recrutment_id
            LEFT JOIN structure s ON s.structure_id = br.structure_id
            where o.offre_titre like '%$this->recherche%'
             or s.structure_designation like '%$this->recherche%'  or br.besoin_recrutment_titre_offre like '%$this->recherche%'
        ")[0]->total ;

        $start = $this->index*$this->offset ;
        DB::select("SET @rownum = 0;") ;
        $this->offrows = DB::select("SELECT @rownum := @rownum + 1 AS row_index ,  o.* , tc.type_contrat_nom , w.wilaya_designation , br.besoin_recrutment_titre_offre , s.structure_designation ,
            (case when o.offre_date_limit_condidature < CURDATE() then 1 else 0 end ) as expire ,
            cand.total as total_candidatures
            from offre o
            LEFT JOIN type_contrat tc ON tc.type_contrat_id = o.offre_type_contrat
            LEFT JOIN wilaya w ON w.wilaya_id = o.offre_lieu
            LEFT JOIN besoin_recrutment br ON br.besoin_recrutment_id = o.besoin_recrutment_id
            LEFT JOIN structure s ON s.structure_id = br.structure_id
            LEFT JOIN (
                SELECT count(*) as total , offre_id
                from candidat
                group by offre_id
            ) cand on cand.offre_id = o.offre_id
            where o.offre_titre like '%$this->recherche%'
             or s.structure_designation like '%$this->recherche%'  or br.besoin_recrutment_titre_offre like '%$this->recherche%'
            Order by o.offre_date_limit_condidature desc
            LIMIT $this->offset OFFSET $start

        ");

        DB::select("SET @rownum = 0;") ;



         $this->sortBy = ['column' => 'nom', 'direction' => 'asc'];
    }
    public function render()
    {
        return view('livewire.offre');
    }

    public function sortBy($field)
    {
        $this->sortBy = $field;
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
   

    public function opnformulaireao()
    {
        $this->showFormulaireao  = true;
        //dd($this->selected);
    }
    #[On("cancelFormulaireao")]
    public function hideFormulaire()
    {
        $this->reload();
        $this->showFormulaireao  = false;
    }


}
