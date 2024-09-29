<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Accueil extends Component
{
    public $rows;

    public $wilayaheaders = [['key' => 'wilaya_designation', 'label' => 'Wilaya'],
    ['key' => 'wilaya_nbr', 'label' => 'Employés']];
    public $wilayarows = [];
    public $departementheaders = [
    ['key' => 'structure_designation', 'label' => 'Département'],
    ['key' => 'structure_nbr', 'label' => 'Employés']];
    public $departementrows = [];
    public $data = [];

    public function mount()
    {
        $this->data = DB::selectOne("SELECT
                                        (select count(*) from agent) as  total_agent,
                                        (select count(*) from offre) as  total_offre,
                                        (select count(*) from candidat) as  total_candidat,
                                        (select count(*) from entretient) as  total_entretien,
                                        (SELECT COUNT(*)FROM occupation WHERE date_debut_fonction <= CURDATE() AND (date_fin_fonction IS NULL OR date_fin_fonction >= CURDATE())) as actif,

                                        (SELECT
                                          ROUND(
                                            SUM(
                                              DATEDIFF(CURDATE(), date_debut_fonction) / 365.25
                                            ) / COUNT(DISTINCT agent_id), 2
                                          )
                                        FROM occupation
                                        WHERE date_fin_fonction IS NULL OR date_fin_fonction > CURDATE()
                                        ) AS Moy_annes_experiance,
                                        (select count(agent_genre) from agent where agent_genre !=0) as  Hommes,
                                        (select count(agent_genre) from agent where agent_genre =0) as  Femmes,
                                        (select count(wilaya_id) from agent where wilaya_id =0) as  Etrangers,
                                        (select count(fonction_id) from agent where fonction_id =5) as  Cadres_dirigeant,
                                        (select count(diplome_institution) from diplome where diplome_institution is not null) as  Universitaires,

                                        (
                                          SELECT
                                            ROUND(
                                              SUM(
                                                DATEDIFF(CURDATE(), a.agent_date_nais) / 365.25
                                              ) / COUNT(DISTINCT a.agent_id), 2
                                            )
                                          FROM agent a
                                          JOIN occupation o ON a.agent_id = o.agent_id
                                          WHERE (o.date_fin_fonction IS NULL OR o.date_fin_fonction > CURDATE())
                                        ) AS Age_moyen_actifs,

                                        (select count(agent_sf) from agent where agent_sf !=0) as  Nb_mariees
                                     ");

        $this->loadData();
    }

    public function loadData()
    {
        $this->wilayarows = DB::select("SELECT COALESCE( w.wilaya_designation,'etranger')as wilaya_designation,w.wilaya_id, COUNT(*) as wilaya_nbr
                                 FROM agent a
                                 LEFT JOIN wilaya w ON a.wilaya_id = w.wilaya_id
                                 GROUP BY w.wilaya_id");

       $this->departementrows = DB::select("SELECT s.structure_designation,s.structure_id, COUNT(*) as structure_nbr
                                FROM agent a
                                LEFT JOIN structure s ON a.structure_id = s.structure_id
                                GROUP BY s.structure_id");
    }

    public function render()
    {
        return view('livewire.accueil');
    }
}
