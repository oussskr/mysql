<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Formulaire2 extends Component
{
    use Toast;
public function  opnformulaire2 (){
    $this->dispatchBrowserEvent('opnformulaire2', ['url' => '/formulaire2']);

}
   
    public function render()
    {
        return view('livewire.formulaire2');
    }
}
