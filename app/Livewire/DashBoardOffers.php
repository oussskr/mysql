<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class DashBoardOffers extends Component
{
    public $offers = [];
    public $postuler = false;
    public $index = 0;
    public $offset = 6;
    public $total = 0 ; 

    public function mount()
    {
        $this->loadData() ; 
    }
    
    public function setIndex($i) {
        if($this->total > count($this->offers)) {
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
            LEFT JOIN type_contrat tc ON tc.type_contrat_id = o.offre_type_contrat
            LEFT JOIN wilaya w ON w.wilaya_id = o.offre_lieu
            where o.offre_date_limit_condidature > now() and o.bloque = 0 
        ")[0]->total ;

        $start = $this->index*$this->offset ;
        DB::select("SET @rownum = 0;") ;
        $this->offers = DB::select("SELECT @rownum := @rownum + 1 AS row_index ,  o.* , tc.type_contrat_nom , w.wilaya_designation
            from offre o
            LEFT JOIN type_contrat tc ON tc.type_contrat_id = o.offre_type_contrat
            LEFT JOIN wilaya w ON w.wilaya_id = o.offre_lieu
            where o.offre_date_limit_condidature > now() and o.bloque = 0 
            Order by o.offre_date_limit_condidature desc
            LIMIT $this->offset OFFSET $start
        ");
        
        DB::select("SET @rownum = 0;") ;

    }
    #[On('hideModlar')]
    public function hideModlar() {
        $this->postuler = false;
        
    }
    public function render()
    {
        return view('livewire.dash-board-offers');
    }
}
