
<div class="w-full">

    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
    @foreach ($offers as $offre)
        <div  class="flex items-start  rounded-lg bg-white p-0 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]  ring-1 ring-white/[0.05] transition duration-300   hover:text-black/70 hover:ring-black/20
            focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900
            dark:ring-zinc-800 dark:hover:text-white/70
            dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
        <x-mary-card title="{{$offre->offre_titre}}" subtitle="{{$offre->offre_description}}" shadow separator class="w-full h-full">
            <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                Compétance requises : 
            </div>
            <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                {{$offre->offre_competences_requises}}
            </div>
           
            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                        Type de contrat : 
                    </div>
                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                        {{$offre->type_contrat_nom}}
                    </div>   
                </div>
                <div class="">
                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                        Niveau d'étude : 
                    </div>
                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                        {{$offre->niveau_etude}}
                    </div>   
                </div>
                <div class="">
                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                        Lieu : 
                    </div>
                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                        {{$offre->wilaya_designation}}
                    </div> 
                </div>
                <div class="">
                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                    Date limite : 
                    </div>
                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                    {{$offre->offre_date_limit_condidature}}
                    </div>
                </div>
            </div>
          <div style="width : 100% ; display : flex ; align-items : center ; justify-content : flex-end ; ">
              <x-mary-button label="Postuler" class="btn-primary ml-3" @click="$wire.postuler = true" 
              wire:click="$dispatch('setDescreption' , { id: {{ $offre->offre_id }} } )"  />
    
          </div>
    
        </x-mary-card>
        
    
        </div>
    @endforeach
    
    <x-mary-modal wire:model="postuler" persistent class="backdrop-blur">
            <div></div>
                <livewire:formulaire>
                <x-mary-button label="Cancel" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" @click="$wire.postuler = false" />
            
        </x-mary-modal>
    </div>
    
    
    <div class="my-3 w-full" style="width : 100% ; display : flex ; align-items : center ; justify-content : center ;">
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