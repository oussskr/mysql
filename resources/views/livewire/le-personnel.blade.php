<div class="bg-gray-100 dark:bg-gray-900 h-screen">
    <div class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Le personnel') }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-100 row m-0" style="padding : 5px ; padding-right : 15px ;">
                <div style="display : flex ; align-items : center ; justify-content : space-between ;">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>Employés :</p>
            </div>
        </div>
    </div>

    <div class="flex gap-4 my-4 px-4" style="justify-content : flex-end ; align-items : flex-end">
                <x-mary-input label="" wire:model="recherche" placeholder="Rechercher" clearable wire:keydown.enter="afficher" />
                <x-mary-button label="Afficher" class="btn-success" wire:click="afficher" />
                <x-mary-button label="Nouveau employé" @click="$wire.showFormulaireae = true" class="btn-primary" spinner="save2" />
            </div>

            <div class="overflow-x-auto">
                <x-mary-table :headers="$headers" :rows="$rows"
                 {{-- :sort-by="$sortBy" :sort-direction="$sortDirection" --}}
                  link="/agentur/{agent_id}">
                    @scope('cell_agent_actif', $row)
                        @if($row->agent_actif)
                            <x-mary-badge :value="'Actif'" class="badge-success" style="min-width: 100px; font-size: 13px; color: white;" />
                        @else
                            <x-mary-badge :value="'Inactif'" class="badge-danger" style="min-width: 100px; font-size: 13px; color: white;" />
                        @endif
                    @endscope


                    @scope('cell_agent_genre', $row)
                        @if($row->agent_genre == 0)
                            <x-mary-badge :value="'Homme'" class="badge-dark" style="min-width: 100px; font-size: 13px; color: white;" />
                        @else
                            <x-mary-badge :value="'Femme'" class="badge-dark" style="min-width: 100px; font-size: 13px; color: white;" />
                        @endif
                    @endscope


                    @scope('cell_agent_sf', $row)
                        @if($row->agent_sf == 0)
                            <x-mary-badge :value="'Non'" class="badge-dark" style="min-width: 100px; font-size: 13px; color: white;" />
                        @else
                            <x-mary-badge :value="'Oui'" class="badge-dark" style="min-width: 100px; font-size: 13px; color: white;" />
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
        </div>

      
        <x-mary-modal wire:model="showFormulaireae" persistent class="backdrop-blur" >
            <livewire:formulaireae />
        </x-mary-modal>
    </div>
