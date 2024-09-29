<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Mary\Traits\Toast;
use Mary\Traits\WithMediaSync;
use Livewire\WithFileUploads;



class Formulaire extends Component
{
    use Toast;
    use WithFileUploads, WithMediaSync;


    public $file   ;


    #[Rule('required')]
    public \Illuminate\Support\Collection $library ;

    public string $descreption = '';
    public string $prenom = '';
    public string $nom = '';
    public Carbon $candidat_date_nais ;
    public string $candidat_nationalite = '';
    public bool $candidat_sf = false;
    public string $candidat_prenom_du_pere = '';
    public string $candidat_nom_prenom_mere = '';
    public string $candidat_tel = '';
    public string $candidat_email = '';
    public string $candidat_nbr_enfant = '';
    public string $diplome_designation = '';
    public string $candidat_addresse = '';
    public $offre = null ;
    protected $casts = [
    'library' => 'Collection'];


    public function mount()
     {
        $this->library=new \Illuminate\Support\Collection();
     }

     public function save()
    {
        $this->validate([
            'file' => 'image|max:400', // 1MB Max
        ]);
        $id = uniqid() ;
         $this->file->storeAs('documents' , $id);
    }

    public ?int $offre_id = null;
    #[On('setDescreption')]
    public function setDescreption($id)
    {

        $this->offre_id = $id;
        $this->offre = DB::selectOne("SELECT
                        o.offre_id,
                        o.offre_titre ,
                        o.offre_description
                    FROM offre o
                    where o.offre_id= $id");
        $this->descreption = $this->offre->offre_description;


    }
    public function postuler()
    {
       $check =  DB::table('candidat')->where([
            'candidat_nom' => $this->nom,
            'candidat_prenom' => $this->prenom,
            'candidat_date_nais' => $this->candidat_date_nais,
            'offre_id' => $this->offre_id,

        ])->first();
        if($check != null)
        {

            $this->dispatch('hideModlar');
            $this->error('votre candidateurs a etait deja sumit avec success');
            return;
        }

        $file_path = "" ;
        if ($this->file && $this->file->isValid()) {
            $id_uniq = uniqid() ;
            $path = $this->file->storeAs('public/documents', "candidat_cv_".$id_uniq.".".$this->file->extension() );
            if($path && $path != "") {
                $file_path = "storage/documents/"."candidat_cv_".$id_uniq.".".$this->file->extension() ;
            }
        }

        $today = Carbon::now()->isoFormat('YYYY-MM-DD');
        $status = 'En cours' ;
        // Acceptée
        // Rejetée

        DB::table('candidat')->insert([
            'candidat_nom' => $this->nom,
            'candidat_prenom' => $this->prenom,
            'candidat_prenom_du_pere' => $this->candidat_prenom_du_pere,
            'candidat_nom_prenom_mere' => $this->candidat_nom_prenom_mere,
            'offre_id' => $this->offre_id,
            'candidat_date_nais' => $this->candidat_date_nais,
            'candidat_nationalite' => $this->candidat_nationalite,
            'candidat_sf' => $this->candidat_sf,
            'candidat_tel' => $this->candidat_tel,
            'candidat_email' => $this->candidat_email,
            'candidat_nbr_enfant' => $this->candidat_nbr_enfant,
            'diplome_designation' => $this->diplome_designation,
            'candidat_addresse' => $this->candidat_addresse,
            'demande_recrutment_date' => $today,
            'demande_recrutment_statut' => $status,
            'candidat_cv' => $file_path,
        ]);
        $this->dispatch('hideModlar');
        $this->success('votre candidateurs a etait sumit avec success');

    }
    public function render()
    {
        return view('livewire.formulaire');
    }
}
