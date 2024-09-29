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


class Formulairedip extends Component
{
    public function render()
    {
        return view('livewire.formulairedip');
    }


    use Toast;
    use WithFileUploads, WithMediaSync;

    
   
    public string $diplome_id = '';
    public string $diplome_designation = '';
   
    public \Illuminate\Support\Collection $library ;
   


    public function  opnformulairedip (){
        $this->dispatchBrowserEvent('opnformulairedip', ['url' => '/formulairedip']);
    
    }
      
         public function postuler()
    {
       $check =  DB::table('diplome')->where([
                  
            'diplome_id' => $this->diplome_id,
         
                 
        ])->first();
        if($check != null)
        {
            $this->dispatch('hideModlar');

            $this->error('votre diplome a etait deja sumit avec success');
            return;
        }


       
        

     


        DB::table('diplome')->insert([
            'diplome_id' => $this->diplome_id,
            'diplome_designation' => $this->diplome_designation,
           
            


        ]);
        $this->dispatch('hideModlar');
        $this->success('votre diplome a etait sumit avec success');
      
    }








}









