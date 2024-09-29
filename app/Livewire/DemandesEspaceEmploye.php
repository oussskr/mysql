<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class DemandesEspaceEmploye extends Component
{

    public $postuler = false;

    public $canheaders;
    public $canrows;
    public $sortBy;
    public $sortDirection;
    public $showAdd = false;
    public $recherche = "";
    public $index = 0;
    public $offset = 10;
    public $total = 0 ;
    public $structure_id ;


    public function mount()



        {
            $this->reload();
        }


        public function reload()
        {
        $this->canheaders = [
            ['key' => 'demande_employe_id', 'label' => '', 'class' => 'hidden' ],
            ['key' => 'row_index', 'label' => 'Index', 'class' => 'w-16'],
            ['key' => 'structure_designation', 'label' => 'Structure', 'class' => 'w-72'],
            ['key' => 'demande_titre', 'label' => 'Titre', 'class' => 'w-40'],
            ['key' => 'demande_employe_date', 'label' => 'Date', 'class' => 'w-40'],
            ['key' => 'status', 'label' => 'Etat', 'class' => 'w-40'],


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
        $this->structure_id = auth()->user()->structure_id ;
        $this->total = DB::select("SELECT count(*) as total
            from demande_employe de
            LEFT JOIN structure s ON s.structure_id = de.structure_id
            where s.structure_id = $this->structure_id AND (  s.structure_designation like '%$this->recherche%'  or de.demande_titre like '%$this->recherche%' )
        ")[0]->total ;
        $start = $this->index*$this->offset ;
        DB::select("SET @rownum = 0;") ;
        $this->canrows = DB::select(" SELECT
            @rownum := @rownum + 1 AS row_index ,
            de.*,
            s.structure_designation
            from demande_employe de
            LEFT JOIN structure s ON s.structure_id = de.structure_id
            where s.structure_id = $this->structure_id AND (  s.structure_designation like '%$this->recherche%'  or de.demande_titre like '%$this->recherche%' )
            order by de.demande_employe_date  desc
            LIMIT $this->offset OFFSET $start
        ");

        DB::select("SET @rownum = 0;") ;
         $this->sortBy = [];
    }
    public function render()
    {
        return view('livewire.demandesEspaceEmploye');
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

     #[On('hideModlar')]
    public function hideModlar() {
        $this->postuler = false;
        $this->reload() ;

    }

}
