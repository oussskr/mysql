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


class Formulaireusr extends Component
{
    public function render()
    {
        return view('livewire.formulaireusr');
    }


    use Toast;
    use WithFileUploads, WithMediaSync;

    
   
    public string $id = '';
    public string $nom = '';
    public string $email = '';
   
    public \Illuminate\Support\Collection $library ;
   


    public function  opnformulaireusr (){
        $this->dispatchBrowserEvent('opnformulaireusr', ['url' => '/formulaireusr']);
    
    }
      
         public function postuler()
    {
       $check =  DB::table('user')->where([
                  
            'id' => $this->id,
            'email' => $this->email,
                 
        ])->first();
        if($check != null)
        {
            $this->dispatch('hideModlar');

            $this->error('votre user a etait deja sumit avec success');
            return;
        }


       
        

     


        DB::table('user')->insert([
            'id' => $this->id,
            'nom' => $this->nom,
            'email' => $this->email,
            


        ]);
        $this->dispatch('hideModlar');
        $this->success('votre user a etait sumit avec success');
      
    }








}









