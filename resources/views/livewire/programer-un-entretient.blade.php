

<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('list des entretient') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>liste des entretients:</p>
            </div>
            <div class="flex gap-4 my-4 px-4" style="justify-content : flex-end ; align-items : flex-end">
                <x-mary-input label="Recherche" wire:model="recherche" placeholder="Rechercher" clearable />
                 <x-mary-datetime label="Date début" wire:model="date_debut" icon="o-calendar" />
                <x-mary-datetime label="Date fin" wire:model="date_fin" icon="o-calendar" />
                <x-mary-button label="Afficher" class="btn-success"  wire:click="afficher" />


            </div>

            {{-- <x-mary-button  label="programer un entretient"  wire:click="setShowAdd" class="btn-primary" spinner="save2" /> --}}
            <x-mary-table :headers="$entheaders" :rows="$entrows" :sort-by=$sortBy  link="/candidature/{candidat_id}">
                @scope('cell_entretien_date', $offrow)
                    @if($offrow->active == 1)
                        <x-mary-badge :value="$offrow->entretien_date" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-info" /> 
                    @else
                        <x-mary-badge :value="$offrow->entretien_date" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-red-600 text-white font-bold py-2 px-4 shadow " /> 
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

         <livewire:personal-add />
    @endif
</div>


