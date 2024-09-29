<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Agentur extends Component
{


    public $postuler = false;


    public $agentur_id ;
    public $agentur ;

    public $row_decoration = [] ;
    public array $expanded = [];

    public $tabs_headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'hidden'],
        ['key' => 'name', 'label' => ''],
    ];

    public $tabs = [
        [
            "id" => 1 ,
            "name" => "Document" ,
            "headers" =>  [
                ['key' => 'id', 'label' => '#', 'class' => 'hidden'],
                ['key' => 'name', 'label' => 'Document'],
                ['key' => 'actions', 'label' => 'Actions'],
            ] ,
            "rows" =>  [
                ["id" => 1 , "name" =>  "CV" , "actions" =>  ""]
            ]
        ] ,
        ["id" => 2 , "name" => "Enfants" ,
        "headers" =>  [
            ['key' => 'id', 'label' => '#', 'class' => 'hidden'],
            ['key' => 'name', 'label' => 'Prénom'],
            ['key' => 'age', 'label' => 'Age'],
            ['key' => 'actions', 'label' => 'Actions'],
        ] ,
        "rows" =>  [

        ]
        ] ,
        ["id" => 3 , "name" => "Conjoint" ,
        "headers" =>  [
            ['key' => 'id', 'label' => '#', 'class' => 'hidden'],
            ['key' => 'name', 'label' => 'Nom'],
            ['key' => 'lastname', 'label' => 'Prénom'],
            ['key' => 'nais', 'label' => 'Date de nais'],
            ['key' => 'place', 'label' => 'Lieu'],
            ['key' => 'actions', 'label' => 'Actions'],
        ] ,
        "rows" =>  [

        ]
        ] ,
        ["id" => 4 , "name" => "Cariere" , "headers" =>  [] , "rows" =>  [] ] ,
        ["id" => 5 , "name" => "Experiance" , "headers" =>  [] , "rows" =>  [] ] ,
        ["id" => 6 , "name" => "Formation proffesionnel" , "headers" =>  [] , "rows" =>  [] ] ,
    ];


    public function mount($id)
        {
            $this->agentur_id = $id ;
            $this->reload();
        }



        public function reload()
        {

            if($this->agentur_id) {
                $this->agentur = DB::selectOne("SELECT a.* ,
                        s.structure_designation, f.fonction_nom,
                        CASE WHEN a.wilaya_id = 0 THEN a.agent_nationalite ELSE w.wilaya_designation END AS wilaya_designation,

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
                        d.diplome_designation ,
                        u.id as user_id
                    from agent a
                    LEFT JOIN fonction f ON a.fonction_id = f.fonction_id
                    LEFT JOIN structure s ON a.structure_id = s.structure_id
                    LEFT JOIN wilaya w ON a.wilaya_id = w.wilaya_id
                    LEFT JOIN diplome d ON d.diplome_id = a.diplome_id
                    LEFT JOIN users u on u.agent_id = a.agent_id
                    where a.agent_id = $this->agentur_id ;
                ") ;


                DB::select("SET @rownum = 0;") ;

            $this->row_decoration = [
            ];

            }
    }

    public function render()
    {
        return view('livewire.agentur');
    }


    #[On('hideModlar')]
    public function hideModlar() {
        $this->postuler = false;
        $this->reload() ;

    }

   


}
