<?php
namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PaysVille extends Component
{
    use WithPagination;

    public $headers = [];
    public $recherche = "";

    public function mount()
    {
        $this->reload();
    }

    public function reload()
    {
        $this->headers = [
            ['key' => 'wilaya_id', 'label' => 'ID', 'class' => 'w-16'],
            ['key' => 'wilaya_designation', 'label' => 'Wilaya', 'class' => 'w-72'],
        ];
    }

    public function render()
    {
        $wilaya = DB::table('wilaya')
            ->where('wilaya_designation', 'like', "%$this->recherche%")
            ->paginate(10); // Adjust the number of items per page as needed

        return view('livewire.pays-ville', [
            'wilaya' => $wilaya,
        ]);
    }
}
