<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Settings extends Component
{
    public $headers=[];
    public $wilaya =[];
    public $usersheaders=[];
    public $users =[];
    public $diplomeheaders=[];
    public $diplome =[];
    public $dptheaders=[];
    public $dpt =[];
    public $recherche = "";
    public $showAdd = false;


  

    public function mount()
    {
        $this->reload();
    }
    public function reload()
    {
        $this->headers = [
            ['key' => 'wilaya_id', 'label' => 'id', 'class' => 'w-16'],
            ['key' => 'wilaya_designation', 'label' => 'designation', 'class' => 'w-72'],

        ];
        $this->wilaya = DB::select("SELECT
                                        wilaya_id ,
                                        wilaya_designation
                                    from wilaya
                                     where wilaya_designation like '%$this->recherche%';");

          $this->dptheaders = [
            ['key' => 'structure_id', 'label' => 'id', 'class' => 'w-16'],
             ['key' => 'structure_designation', 'label' => 'designation', 'class' => 'w-72'],

              ];
             $this->dpt = DB::select("SELECT
                                      structure_id ,
                                  structure_designation
                                   from structure
                                     where structure_designation like '%$this->recherche%';");

                $this->diplomeheaders = [
                    ['key' => 'diplome_id', 'label' => 'id', 'class' => 'w-16'],
                    ['key' => 'diplome_designation', 'label' => 'designation', 'class' => 'w-72'],

                    ];
                    $this->diplome = DB::select("SELECT
                                            diplome_id ,
                                        diplome_designation
                                        from diplome
                                            where diplome_designation like '%$this->recherche%';");

            $this->usersheaders = [
            ['key' => 'id', 'label' => 'id', 'class' => 'w-16'],
            ['key' => 'nom', 'label' => 'user_name', 'class' => 'w-72'],
            ['key' => 'email', 'label' => 'email', 'class' => 'w-40'],
            ['key' => 'agent_nom', 'label' => 'agent_nom', 'class' => 'w-40'],
            ['key' => 'role_designation', 'label' => 'role', 'class' => 'w-40'],
            ['key' => 'agent_id', 'label' => 'agent_matricule', 'class' => 'w-40'],

    ];
    $this->users = DB::select("SELECT
                            u.id ,
                        u.nom,
                        u.email,
                        a.agent_nom,
                        r.role_designation,
                        a.agent_id
                        from users u
                        LEFT JOIN agent a ON u.agent_id = a.agent_id
                        LEFT JOIN role r ON u.role_id = r.role_id

                            where nom like '%$this->recherche%';");
                    }
    public function render()
    {
        return view('livewire.settings');
    }

    public function setShowAdd()
    {
        //$this->showAdd = true;
    }
   #[On("cancel")]
    public function hideAdd()
    {
        $this->showAdd = false;
    }

}
