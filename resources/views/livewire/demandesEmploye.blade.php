

<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Demandes Employés') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>Liste des Demandes :</p>
            </div>

            <div class="flex gap-4 my-4 px-4" style="justify-content : flex-end ; align-items : flex-end">
                <x-mary-input label="" wire:model="recherche" placeholder="Rechercher" clearable  wire:keydown.enter="afficher"/>
                <x-mary-button label="Afficher" class="btn-success"  wire:click="afficher" />


            </div>
            <x-mary-table :headers="$canheaders" :rows="$canrows" :sort-by=$sortBy   @row-click="$wire.postuler = true ; $dispatch('setDescreption' , { id: $event.detail.demande_employe_id , readOnly : true  } ) ;">
                @scope('cell_status', $offrow)
                    @if($offrow->status == 1)
                        <x-mary-badge value="Validée" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-success" /> 
                    @elseif($offrow->status == 0)
                        <x-mary-badge value="En cours" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-warning" /> 
                    @elseif($offrow->status == -1)
                        <x-mary-badge value="Réfusée" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-red-600 text-white font-bold py-2 px-4 shadow " /> 
                    @else 
                        <x-mary-badge value="--" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-dark" /> 

                    @endif
                @endscope
                
            </x-mary-table>
            <div class="my-3" style="width : 100% ; display : flex ; align-items : center ; justify-content : center ;">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-sm">
                        <li>
                            <button   wire:click="setIndex({{$index == 0 ? ($index+1) :  ($index) }})"class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Précédent
                            </button>
                        </li>
                    @for ($i = 1; $i <= (int)($this->total / $offset) + ($this->total % $offset == 0 ? 0 : 1 ) ; $i++)
                    <li>
                        @if($index + 1 != $i)
                            <button 
                                wire:click="setIndex({{$i}})" 
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                {{ $i }}
                            </button>

                        @else 
                            <button 
                                wire:click="setIndex({{$i}})" 
                                class="flex items-center justify-center px-3 h-8 leading-tight  border border-gray-300 bg-gray-100 text-gray-700  dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                {{ $i }}
                            </button>

                        @endif
                    </li>
                    @endfor
                    <li>
                    <button  wire:click="setIndex({{$index < (int)($total/10)-1 ? $index+2 : $index+1}})"  class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white">
                        Suivant
                        </button>
                    </li>
                        
                    </ul>
                </nav>
            </div>
            <div class="my-3" style="width : 100% ; display : flex ; align-items : center ; justify-content : center ;">
                <p href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white   dark:bg-gray-800  dark:text-gray-400  ">
                            Total : {{$total}}
                </p>
            
            </div>
            
        </div>
       
    </div>
    @if ($showAdd)
  <livewire:formulaire2> 
            <x-mary-toast  />   
         <livewire:personal-add />
    @endif
    

    <x-mary-modal wire:model="postuler" persistent class="backdrop-blur">
        <div></div>
            <livewire:formulaireCreateDemande>
            <x-mary-button label="Cancel" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" @click="$wire.postuler = false" />
        
    </x-mary-modal>
</div>


