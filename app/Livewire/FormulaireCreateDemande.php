<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;
use Mary\Traits\WithMediaSync;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;



class FormulaireCreateDemande extends Component
{
    use Toast;
    use WithFileUploads, WithMediaSync;

    
    public $file   ; 
    
    
    #[Rule('required')]
    public \Illuminate\Support\Collection $library ;

    public string $descreption = '';
    public bool $readOnly = false ; 
    public string $titre = '';
    public string $contenu = '';
    public $offre = null ; 


    protected $casts = [
    'library' => 'Collection'];


    public function mount()
     {
        $this->library=new \Illuminate\Support\Collection();
     }
     

    public ?int $offre_id = null;
    #[On('setDescreption')]
    public function setDescreption($id , $readOnly = false)
    {
       $this->readOnly = $readOnly ; 
       $this->offre_id = $id;
        if($readOnly) {
            $this->offre = DB::selectOne("SELECT  
            de.*,
            a.agent_nom , 
            a.agent_prenom ,
            s.structure_id ,
            s.structure_designation 
            from demande_employe de
            LEFT JOIN agent a ON a.agent_id = de.agent_id
            LEFT JOIN structure s ON s.structure_id = de.structure_id
            where de.demande_employe_id = $this->offre_id ;
        ") ;
        $this->contenu = $this->offre->demande_contenu ; 

        }else {
            $this->offre = DB::selectOne("SELECT  
                u.*,
                a.agent_nom , 
                a.agent_prenom ,
                s.structure_id ,
                s.structure_designation 
                from users u
                LEFT JOIN agent a ON a.agent_id = u.agent_id
                LEFT JOIN structure s ON s.structure_id = a.structure_id
                where u.id = $this->offre_id ;
            ") ;

        }
        $this->descreption = $this->offre->agent_nom.' '.$this->offre->agent_prenom;
       
       
    }
    public function postuler()
    {
        
        if($this->titre == ''  )
        {
            $this->error('Merci de saisir le titre');
            return;
        }else if($this->contenu == '') {
            $this->error('Merci de saisir le contenu');
            return;

        }
        

        $today = Carbon::now()->isoFormat('YYYY-MM-DD');

        DB::table('demande_employe')->insert([
            "demande_titre" => $this->titre , 
            "demande_contenu" => $this->contenu , 
            "agent_id" => $this->offre->agent_id  ,
            "structure_id" => $this->offre->structure_id  ,
            "status" => 0 , 
            "demande_employe_date" => $today , 
        ]);
        $this->dispatch('hideModlar');
        $this->success('Demande envoyée avec succès');
       
    }
    public function render()
    {
        return view('livewire.formulaireCreateDemande');
    }
}
