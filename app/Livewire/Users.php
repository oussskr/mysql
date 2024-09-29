<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Users extends Component
{





    public $usersheaders=[];
    public $users =[];
    public $recherche = "";
    public $showAdd = false;


    public $sortBy;
    public $sortDirection;

public $showFormulaireusr = false;


    public function mount()
    {
        $this->reload();
    }
    public function reload()
    {
        $this->usersheaders = [
            ['key' => 'id', 'label' => 'Id', 'class' => 'w-16'],
            ['key' => 'nom', 'label' => 'Utilisateur', 'class' => 'w-72'],
            ['key' => 'email', 'label' => 'Email', 'class' => 'w-40'],
            ['key' => 'agent_nom', 'label' => 'Nom', 'class' => 'w-40'],
            ['key' => 'role_designation', 'label' => 'Rôle', 'class' => 'w-40'],
            ['key' => 'agent_id', 'label' => 'Matricule', 'class' => 'w-40'],

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
  
    public function setShowAdd()
    {
        //$this->showAdd = true;
    }
 
    public function sortBy($field)
{
    $this->sortBy = $field;
    $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
}

public function opnformulaireusr()
{
    $this->showFormulaireusr = true;
    //dd($this->selected);
}


#[On("cancelFormulaireusr")]
public function hideFormulaireusr()
{
    $this->showFormulaireusr = false;
}


    public function render()
    {
        return view('livewire.users');
    }
}
