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



class Formulairedpt extends Component
{



    use Toast;
    use WithFileUploads, WithMediaSync;

    
   
    public string $structure_id = '';
    public string $structure_designation = '';
   
    public \Illuminate\Support\Collection $library ;
   


    public function  opnformulairedpt (){
        $this->dispatchBrowserEvent('opnformulairedpt', ['url' => '/formulairedpt']);
    
    }
      
         public function postuler()
    {
       $check =  DB::table('structure')->where([
                  
            'structure_id' => $this->structure_id,
         
                 
        ])->first();
        if($check != null)
        {
            $this->dispatch('hideModlar');

            $this->error('votre structure a etait deja sumit avec success');
            return;
        }


       
        

     


        DB::table('structure')->insert([
            'structure_id' => $this->structure_id,
            'structure_designation' => $this->structure_designation,
           
            


        ]);
        $this->dispatch('hideModlar');
        $this->success('votre structure a etait sumit avec success');
      
    }







    public function render()
    {
        return view('livewire.formulairedpt');
    }




}









