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



class FormulaireCreateUser extends Component
{
    use Toast;
    use WithFileUploads, WithMediaSync;

    
    public $file   ; 
    
    
    #[Rule('required')]
    public \Illuminate\Support\Collection $library ;

    public string $descreption = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $offre = null ; 

    protected $casts = [
    'library' => 'Collection'];


    public function mount()
     {
        $this->library=new \Illuminate\Support\Collection();
     }
     

    public ?int $offre_id = null;
    #[On('setDescreption')]
    public function setDescreption($agenture)
    {
       
        $this->offre_id = $agenture;
        $this->offre = DB::selectOne("SELECT a.* ,
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
            where a.agent_id = $this->offre_id ;
        ") ;
        $this->descreption = $this->offre->agent_nom.' '.$this->offre->agent_prenom;
       
       
    }
    public function postuler()
    {
        
        if($this->password == ''  )
        {
            $this->error('Merci de saisir votre mot de passe');
            return;
        }else if(strlen($this->password) < 6  )
        {
            $this->error('Le mdp doit avoir au moin 6 caractères !');
            return;
        }else if($this->password_confirmation != $this->password) {
            $this->error('Merci de confirmer votre mot de passe');
            return;

        }
        

        $today = Carbon::now()->isoFormat('YYYY-MM-DD');

        DB::table('users')->insert([
            "nom" => $this->descreption , 
            "email" => $this->offre->agent_email , 
            "password" => Hash::make($this->password) ,
            "email_verified_at" => $today , 
            "created_at" => $today ,
            "agent_id" => $this->offre->agent_id  ,
            "structure_id" => $this->offre->structure_id  ,
            "role_id" => 3
        ]);
        $this->dispatch('hideModlar');
        $this->success('Utilisateur créé avec succès');
       
    }
    public function render()
    {
        return view('livewire.formulaireCreateUser');
    }
}
