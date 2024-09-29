<?php
namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class LePersonnel extends Component
{
    public $headers;
    public $rows;
    public $showFormulaireae = false;
    public $showContractModal = false;
    public $recherche;
    public $showAdd = false;
    public $index = 0;
    public $offset = 10;
    public $total = 0 ;

    public function mount()
    {
        $this->recherche = '';
        $this->reload();
    }

    public function reload()
    {
        $this->headers = [
            ['key' => 'agent_matricule', 'label' => 'Matricule', 'class' => 'w-16'],
            ['key' => 'agent_nom', 'label' => 'Nom', 'class' => 'w-72'],
            ['key' => 'agent_prenom', 'label' => 'Prénom', 'class' => 'w-40'],
            ['key' => 'agent_date_nais', 'label' => 'Date naiss.', 'class' => 'w-40'],
            ['key' => 'agent_genre', 'label' => 'Genre', 'class' => 'w-40'],
            ['key' => 'structure_designation', 'label' => 'Département', 'class' => 'w-40'],
            ['key' => 'fonction_nom', 'label' => 'Fonction', 'class' => 'w-40'],
            ['key' => 'wilaya_designation', 'label' => 'Wilaya', 'class' => 'w-40'],
            ['key' => 'total_experience', 'label' => 'Années exp.', 'class' => 'w-40'],
            ['key' => 'agent_sf', 'label' => 'Mariée ?', 'class' => 'w-40'],
            ['key' => 'agent_actif', 'label' => 'Actif', 'class' => 'w-40'],
        ];

        $this->loadData();
    }



    public function setIndex($i) {
        if($this->total > count($this->rows)) {
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
            FROM agent a
            LEFT JOIN fonction f ON a.fonction_id = f.fonction_id
            LEFT JOIN structure s ON a.structure_id = s.structure_id
            LEFT JOIN wilaya w ON a.wilaya_id = w.wilaya_id
            WHERE a.agent_nom LIKE'%$this->recherche%'
        ")[0]->total ;

        DB::select("SET @rownum = 0;") ;
        $start = $this->index*$this->offset ;
        $query = "SELECT

                a.agent_id, a.agent_matricule, a.agent_nom, a.agent_prenom, a.agent_date_nais, a.agent_genre,
                s.structure_designation, f.fonction_nom,
                CASE WHEN a.wilaya_id = 0 THEN a.agent_nationalite ELSE w.wilaya_designation END AS wilaya_designation,
                a.agent_sf, a.agent_cni, a.agent_numero_securite_sociale,
                (
                    SELECT SUM(TIMESTAMPDIFF(YEAR, o.date_debut_fonction, IF(o.date_fin_fonction IS NULL OR o.date_fin_fonction > CURDATE(), CURDATE(), o.date_fin_fonction)))
                    FROM occupation o
                    WHERE o.agent_id = a.agent_id
                ) AS total_experience,
                (
                    SELECT CASE WHEN MAX(date_fin_fonction) < CURDATE() THEN 0 ELSE 1 END
                    FROM occupation
                    WHERE agent_id = a.agent_id
                ) AS agent_actif ,
                d.diplome_designation
            FROM agent a
            LEFT JOIN fonction f ON a.fonction_id = f.fonction_id
            LEFT JOIN structure s ON a.structure_id = s.structure_id
            LEFT JOIN wilaya w ON a.wilaya_id = w.wilaya_id
            LEFT JOIN diplome d ON d.diplome_id = a.diplome_id
            WHERE a.agent_nom LIKE ? or a.agent_prenom LIKE '%$this->recherche%'
            LIMIT $this->offset OFFSET $start
        ";

        $this->rows = DB::select($query, ["%$this->recherche%"]);


        DB::select("SET @rownum = 0;") ;
    }

    public function showDetails($agentId)
    {
        return redirect()->route('employee-details', ['agentId' => $agentId]);
    }

    public function render()
    {
        return view('livewire.le-personnel');
    }

    public function redirectToAgent($agentId)
    {
        return redirect()->to('/le-personnel/' . $agentId);
    }
    public function opnformulaireae()
    {
        $this->showFormulaireae = true;
        //dd($this->selected);
    }
    #[On("cancelFormulaireae")]
    public function cancelFormulaireae()
    {
        $this->showFormulaireae = false;
    }
}
