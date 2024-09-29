<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;




class Candidature extends Component
{
    public $candidature_id ;
    public $candidature ;
    public $showFormulaire = false ;
    public $entretientrows;
    public $entretientheaders;
    public $row_decoration = [] ;


    public function mount($id)
        {
            $this->candidature_id = $id ;
            $this->reload();
        }

        public function getRowClass($entretientrow)
        {
            return $entretientrow->row_index == 1 ;
        }

        public function reload()
        {
            $this->entretientheaders = [
                ['key' => 'row_index', 'label' => 'Index', 'class' => 'w-16'],
                ['key' => 'entretien_date', 'label' => 'Date', 'class' => 'w-72'],
                ['key' => 'entretien_lieu', 'label' => 'Lieu', 'class' => 'w-72'],
                ['key' => 'entretien_type', 'label' => 'Type', 'class' => 'w-40'],
            ];
            if($this->candidature_id) {
                $this->candidature = DB::selectOne("SELECT c.* ,  o.* , tc.type_contrat_nom , w.wilaya_designation , br.besoin_recrutment_titre_offre , s.structure_designation ,
                    (case when o.offre_date_limit_condidature < CURDATE() then 1 else 0 end ) as expire
                    from candidat c
                    LEFT JOIN offre o on o.offre_id = c.offre_id
                    LEFT JOIN type_contrat tc ON tc.type_contrat_id = o.offre_type_contrat
                    LEFT JOIN wilaya w ON w.wilaya_id = o.offre_lieu
                    LEFT JOIN besoin_recrutment br ON br.besoin_recrutment_id = o.besoin_recrutment_id
                    LEFT JOIN structure s ON s.structure_id = br.structure_id
                    where c.candidat_id = $this->candidature_id ;
                ") ;
                DB::select("SET @rownum = 0;") ;
                $this->entretientrows = DB::select("SELECT
                    @rownum := @rownum + 1 AS row_index ,
                    ent.*
                    from entretient ent
                    where ent.candidat_id = $this->candidature_id
                    order by ent.entretient_id desc
                ");

                DB::select("SET @rownum = 0;") ;

            $this->row_decoration = [
            ];

            }
    }

    public function render()
    {
        return view('livewire.candidature');
    }



    public function opnFormulairetraitercandidature()
    {
        $this->showFormulaire  = true;
        //dd($this->selected);
    }
    #[On("cancelFormulairetraitercandidature")]
    public function hideFormulairetraitercandidature()
    {
        $this->reload();
        $this->showFormulaire  = false;
    }


}
