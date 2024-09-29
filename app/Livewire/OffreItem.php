<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;




class OffreItem extends Component
{
    public $offre_id ;
    public $offre ;

    public $canheaders;
    public $canrows;
    public $sortBy;
    public $sortDirection;
    public $showAdd = false;
    public $recherche = "";


    public $showBloquer = false;
    public $showActiver = false;




    public function mount($id)
        {
            $this->offre_id = $id ;
            $this->reload();
        }


        public function reload()
        {
            if($this->offre_id) {
                $this->offre = DB::selectOne("SELECT   o.* , tc.type_contrat_nom , w.wilaya_designation , br.besoin_recrutment_titre_offre , s.structure_designation ,
                    (case when o.offre_date_limit_condidature < CURDATE() then 1 else 0 end ) as expire
                    from offre o
                    LEFT JOIN type_contrat tc ON tc.type_contrat_id = o.offre_type_contrat
                    LEFT JOIN wilaya w ON w.wilaya_id = o.offre_lieu
                    LEFT JOIN besoin_recrutment br ON br.besoin_recrutment_id = o.besoin_recrutment_id
                    LEFT JOIN structure s ON s.structure_id = br.structure_id
                    where o.offre_id = $this->offre_id ;
                ") ;
                $this->canheaders = [
                    ['key' => 'row_index', 'label' => 'Index', 'class' => 'w-16'],

                    ['key' => 'candidat_nom', 'label' => 'Nom', 'class' => 'w-72'],
                    ['key' => 'candidat_prenom', 'label' => 'Prenom', 'class' => 'w-40'],

                    ['key' => 'diplome_designation', 'label' => 'Diplome', 'class' => 'w-40'],
                    ['key' => 'candidat_nationalite', 'label' => 'Nationalité', 'class' => 'w-40'],
                    ['key' => 'etat', 'label' => 'Etat', 'class' => 'w-40'],
                    ['key' => 'entretient', 'label' => 'Entretien', 'class' => 'w-40'],


                ];
                $this->loadData();
            }
    }

    public function loadData()
    {
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
        s.structure_designation ,
        br.besoin_recrutment_titre_offre,
        s.structure_designation,
        le.entretien_date
        from candidat c
        left JOIN offre o  on o.offre_id = c.offre_id
        LEFT JOIN besoin_recrutment br ON br.besoin_recrutment_id = o.besoin_recrutment_id
        LEFT JOIN structure s ON s.structure_id = br.structure_id
        LEFT JOIN latest_entretien le ON le.candidat_id = c.candidat_id

        where o.offre_id = $this->offre_id and (candidat_nom like '%$this->recherche%' or candidat_prenom like '%$this->recherche%' or offre_titre like '%$this->recherche%')
        order by c.demande_recrutment_date desc
        ");

        DB::select("SET @rownum = 0;") ;
          $this->sortBy = 'agent_nom'; // Initial sort column
            $this->sortDirection = 'asc'; // Initial sort direction

         $this->sortBy = ['column' => 'nom', 'direction' => 'asc'];
    }

    public function sortBy($field)
    {
        $this->sortBy = $field;
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        return view('livewire.offreitem');
    }


    public function opnFormulaireoffrebloque()
    {
        $this->showBloquer  = true;
        //dd($this->selected);
    }
    #[On("cancelFormulaireoffrebloque")]
    public function hideFormulaire()
    {
        $this->reload();
        $this->showBloquer  = false;
    }


}
