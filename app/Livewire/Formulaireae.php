<?php

namespace App\Livewire;

use Livewire\Component;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use Mary\Traits\WithMediaSync;


class Formulaireae extends Component
{

    use Toast;
    use WithFileUploads, WithMediaSync;


    public string $testing_data = '';

    public string $descreption = '';
    public string $prenom = '';
    public string $nom = '';
    public string $matricule = '';
    public string $agent_nationalite = '';
    public bool $agent_sf = false;
    public Carbon $agent_date_nais ;
    public string $agent_prenom_du_pere = '';
    public string $agent_nom_prenom_mere = '';
    public string $agent_tel = '';
    public string $agent_group_sanguin = '';
    public string $agent_cni = '';
    public string $agent_numero_securite_sociale = '';

    public int $agent_genre = 0;

    public string $departement_designation = '';
    public string $structure_designation = '';
    // public string $wilaya_id = '';


    public string $agent_email = '';



    public string $agent_nbr_enfant = '';
    public string $diplome_designation = '';
    public string $agent_addresse = '';

    public ?int $structure_id = null ;
    public ?int $fonction_id = null ; 
    public ?int $wilaya_id = null ; 
    public ?int $diplome_id = null ; 

    public \Illuminate\Support\Collection $library ;
    protected $casts = [
    'library' => 'Collection'];

    public $file   ;


    #[Rule('required')]



    public  $structure_db = [];
    public  $structure = [];
    public  $fonction_db = [];
    public  $fonction = [];


    public  $wilaya_db = [];
    public  $wilaya = [];

    public  $diplome_db = [];
    public  $diplome = [];


    public function loadData()
    {
        $this->structure_db = DB::select("SELECT structure_id as id , structure_designation as name FROM structure ");
        $this->fonction_db = DB::select("SELECT fonction_id as id , fonction_nom as name FROM fonction ");
        $this->wilaya_db = DB::select("SELECT wilaya_id as id , wilaya_designation as name FROM wilaya ");
        $this->diplome_db = DB::select("SELECT diplome_id as id , diplome_designation as name FROM diplome ");


        $this->structure = $this->structure_db  ;
        $this->fonction  = $this->fonction_db  ;
        $this->wilaya  = $this->wilaya_db  ;

        $this->diplome  = $this->diplome_db  ;

    }

    public function searchstructure(string $value = '') {
        $this->structure = array_filter($this->structure_db ,function($element) use ($value) {
            return strpos(strtolower($element->name), strtolower($value)) !== false   ;
        } ) ;
    }

    public function searchfonction(string $value = '') {
        $this->fonction = array_filter($this->fonction_db ,function($element) use ($value) {
            return strpos(strtolower($element->name), strtolower($value)) !== false   ;
        } ) ;
    }
    public function searchWilaya(string $value = '') {
        $this->wilaya = array_filter($this->wilaya_db ,function($element) use ($value) {
            return strpos(strtolower($element->name), strtolower($value)) !== false   ;
        } ) ;
    }
    public function searchDiplome(string $value = '') {
        $this->diplome = array_filter($this->diplome_db ,function($element) use ($value) {
            return strpos(strtolower($element->name), strtolower($value)) !== false   ;
        } ) ;
    }

    



    public function mount()
    {
        $this->loadData() ;
        $this->library=new \Illuminate\Support\Collection();
     }




         public function postuler()
    {
    
       $check =  DB::table('agent')->where([

            'agent_matricule' => $this->matricule,


        ])->first();
        if($check != null)
        {
            // $this->dispatch('hideModlar');

            $this->error('votre agenteurs a etait deja sumit avec success');
            return;
        }


        $file_path = "" ;
        if ($this->file && $this->file->isValid()) {
            $id_uniq = uniqid() ;
            $path = $this->file->storeAs('public/documents', "agent_cv_".$id_uniq.".".$this->file->extension() );
            if($path && $path != "") {
                $file_path = "storage/documents/"."agent_cv_".$id_uniq.".".$this->file->extension() ;
            }
        }

        $today = Carbon::now()->isoFormat('YYYY-MM-DD');

        $agent =    [
            'agent_nom' => $this->nom,
            'agent_prenom' => $this->prenom,
            'agent_matricule' => $this->matricule,
            
            'agent_prenom_du_pere' => $this->agent_prenom_du_pere,
            'agent_nom_prenom_mere' => $this->agent_nom_prenom_mere,
            'agent_tel' => $this->agent_tel,
            'agent_cv' => $file_path,
            'agent_email' => $this->agent_email,
            'agent_nbr_enfant' => $this->agent_nbr_enfant,
            'agent_addresse' => $this->agent_addresse,
            
            'structure_id' => $this->structure_id,
            'fonction_id' => $this->fonction_id,
            'wilaya_id' => $this->wilaya_id,
            'diplome_id' => $this->diplome_id,

            'agent_date_nais' => $this->agent_date_nais,
            'agent_nationalite' => $this->agent_nationalite,
            'agent_sf' => $this->agent_sf,
            'agent_group_sanguin' => $this->agent_group_sanguin,
            'agent_cni' => $this->agent_cni,
            'agent_numero_securite_sociale' => $this->agent_numero_securite_sociale,
            'agent_genre' => $this->agent_genre,

        ] ;
        
        DB::table('agent')->insert($agent);
        // $this->testing_data = json_encode($agent); 


        $this->success('votre agenteurs a etait sumit avec success');
        $this->dispatch('cancelFormulaireae');

    }

    public function save()
    {
        $this->validate([
            'file' => 'image|max:400', // 1MB Max
        ]);
        $id = uniqid() ;
         $this->file->storeAs('documents' , $id);
    }




   public function  opnformulaireae (){
       $this->dispatchBrowserEvent('opnformulaireae', ['url' => '/formulaireae']);

   }

    public function render()
    {
        return view('livewire.formulaireae');
    }
}
