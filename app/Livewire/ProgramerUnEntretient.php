<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ProgramerUnEntretient extends Component
{
    public $entheaders;
    public $entrows;
    public $sortBy;
    public $sortDirection;
    public $showAdd = false;
    public  $date_debut = null ;
    public  $date_fin = null ;
    public $recherche = "";
    public $where = "";
    public $index = 0;
    public $offset = 10;
    public $total = 0 ;

    public function mount()
    {
        $this->entheaders = [
            ['key' => 'row_index', 'label' => 'index', 'class' => 'w-16'],
            ['key' => 'structure_designation', 'label' => 'Structure', 'class' => 'w-40'],
            ['key' => 'offre_titre', 'label' => 'Offre', 'class' => 'w-40'],
            ['key' => 'candidat_nom', 'label' => 'Nom', 'class' => 'w-40'],
            ['key' => 'candidat_prenom', 'label' => 'Prénom', 'class' => 'w-40'],
            ['key' => 'entretien_type', 'label' => 'Type', 'class' => 'w-40'],
            ['key' => 'entretien_lieu', 'label' => 'Lieu', 'class' => 'w-40'],
            ['key' => 'entretien_date', 'label' => 'Date', 'class' => 'w-72'],


        ];
        $this->loadData();


    }
    public function setIndex($i) {
        if($this->total > count($this->entrows)) {
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

        $this->where = "Where 1 = 1 " ;
        if($this->recherche != "") {
            $this->where .= " AND (c.candidat_nom like '%$this->recherche%' OR c.candidat_prenom like '%$this->recherche%' OR o.offre_titre like '%$this->recherche%'  OR s.structure_designation like '%$this->recherche%' ) " ;
        }

        if($this->date_debut) {
            $this->where .= " AND e.entretien_date >= '$this->date_debut' " ;
        }

        if($this->date_fin) {
            $this->where .= " AND e.entretien_date <= '$this->date_fin' " ;
        }

        $this->total = DB::select("SELECT count(*) as total
            FROM entretient e
            LEFT JOIN structure s ON e.structure_id = s.structure_id
            LEFT JOIN candidat c  ON e.candidat_id = c.candidat_id
            LEFT JOIN offre o on o.offre_id = c.offre_id
            $this->where
        ")[0]->total ;

        $start = $this->index*$this->offset ;
        DB::select("SET @rownum = 0;") ;
        $this->entrows = DB::select("   SELECT
                                            @rownum := @rownum + 1 AS row_index ,
                                            e.entretient_id,
                                            e.entretien_date,
                                            e.entretien_lieu,
                                            e.entretien_type,
                                            s.structure_designation,
                                            c.candidat_id ,
                                            c.candidat_nom ,
                                            c.candidat_prenom ,
                                            o.offre_titre ,
                                            (case when e.entretien_date < now() then 0 else 1 end ) as active

                                        FROM entretient e
                                        LEFT JOIN structure s ON e.structure_id = s.structure_id
                                        LEFT JOIN candidat c  ON e.candidat_id = c.candidat_id
                                        LEFT JOIN offre o on o.offre_id = c.offre_id
                                        $this->where
                                        order by e.entretien_date desc
                                        LIMIT $this->offset OFFSET $start
        ");
        DB::select("SET @rownum = 0;") ;

          $this->sortBy = 'entretien_date'; // Initial sort column
    $this->sortDirection = 'asc'; // Initial sort direction

         $this->sortBy = ['column' => 'nom', 'direction' => 'asc'];
    }
    public function render()
    {
        return view('livewire.programer-un-entretient');
    }


    public function sortBy($field)
    {
        $this->sortBy = $field;
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function setShowAdd()
    {
        //$this->showAdd = true;
    }
    #[On("cancel")]
    public function hideAdd()
    {
        //$this->showAdd = false;
    }

}
