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


class Formulairefon extends Component
{

    
    use Toast;
    use WithFileUploads, WithMediaSync;


    
   
    public string $fonction_id = '';
    public string $fonction_nom = '';
   
    public \Illuminate\Support\Collection $library ;
   

    public function  opnformulairefon (){
        $this->dispatchBrowserEvent('opnformulairefon', ['url' => '/formulairefon']);
    
    }
      
         public function postuler()
    {
       $check =  DB::table('fonction')->where([
                  
            'fonction_id' => $this->fonction_id,
         
                 
        ])->first();
        if($check != null)
        {
            $this->dispatch('hideModlar');

            $this->error('votre fonction a etait deja sumit avec success');
            return;
        }


       
        

     


        DB::table('fonction')->insert([
            'fonction_id' => $this->fonction_id,
            'fonction_nom' => $this->fonction_nom,
           
            


        ]);
        $this->dispatch('hideModlar');
        $this->success('votre fonction a etait sumit avec success');
    }
    public function render()
    {
        return view('livewire.formulairefon');
    }
}









 





