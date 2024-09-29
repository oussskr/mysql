<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Candidat extends Component
{

    public $canheaders;
    public $canrows;
    public $sortBy;
    public $sortDirection;
    public $showAdd = false;
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
        $this->canheaders = [
            ['key' => 'row_index', 'label' => 'Index', 'class' => 'w-16'],
            ['key' => 'structure_designation', 'label' => 'Structure', 'class' => 'w-72'],
            ['key' => 'besoin_recrutment_titre_offre', 'label' => 'Besoin', 'class' => 'w-72'],
            ['key' => 'offre_titre', 'label' => 'Offre', 'class' => 'w-40'],
            ['key' => 'candidat_nom', 'label' => 'Nom', 'class' => 'w-72'],
            ['key' => 'candidat_prenom', 'label' => 'Prenom', 'class' => 'w-40'],

            ['key' => 'diplome_designation', 'label' => 'Diplome', 'class' => 'w-40'],
            ['key' => 'candidat_nationalite', 'label' => 'Nationalité', 'class' => 'w-40'],
            ['key' => 'etat', 'label' => 'Etat', 'class' => 'w-40'],
            ['key' => 'entretient', 'label' => 'Entretien', 'class' => 'w-40'],


        ];
        $this->loadData();


    }
    public function setIndex($i) {
        if($this->total > count($this->canrows)) {
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
            from candidat c
            left JOIN offre o  on o.offre_id = c.offre_id
            LEFT JOIN besoin_recrutment br ON br.besoin_recrutment_id = o.besoin_recrutment_id
            LEFT JOIN structure s ON s.structure_id = br.structure_id
            where candidat_nom like '%$this->recherche%' or candidat_prenom like '%$this->recherche%' or offre_titre like '%$this->recherche%'
            or s.structure_designation like '%$this->recherche%'  or br.besoin_recrutment_titre_offre like '%$this->recherche%'
        ")[0]->total ;
        $start = $this->index*$this->offset ;
        DB::select("SET @rownum = 0;") ;
        $this->canrows = DB::select("  WITH latest_entretien AS (
            SELECT e.candidat_id, e.entretien_date
            FROM entretient e
            WHERE e.entretien_date = (
                SELECT MAX(e2.entretien_date)
                FROM entretient e2
                WHERE e2.candidat_id = e.candidat_id
            )
        )
        SELECT
        @rownum := @rownum + 1 AS row_index ,
        c.*,
        o.offre_titre,
        br.besoin_recrutment_titre_offre,
        s.structure_designation ,
        le.entretien_date
        from candidat c
        left JOIN offre o  on o.offre_id = c.offre_id
        LEFT JOIN besoin_recrutment br ON br.besoin_recrutment_id = o.besoin_recrutment_id
        LEFT JOIN structure s ON s.structure_id = br.structure_id
        LEFT JOIN latest_entretien le ON le.candidat_id = c.candidat_id
        where candidat_nom like '%$this->recherche%' or candidat_prenom like '%$this->recherche%' or offre_titre like '%$this->recherche%'
        or s.structure_designation like '%$this->recherche%'  or br.besoin_recrutment_titre_offre like '%$this->recherche%'
        order by c.demande_recrutment_date desc
        LIMIT $this->offset OFFSET $start
        ");

        DB::select("SET @rownum = 0;") ;
          $this->sortBy = 'agent_nom'; // Initial sort column
            $this->sortDirection = 'asc'; // Initial sort direction

         $this->sortBy = ['column' => 'nom', 'direction' => 'asc'];
    }
    public function render()
    {
        return view('livewire.candidat');
    }


    public function sortBy($field)
    {
        $this->sortBy = $field;
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function setShowAdd()
    {
        $this->showAdd = true;
    }
    #[On("cancel")]
    public function hideAdd()
    {
        $this->showAdd = false;
    }

}
