

<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Ajouter des offres') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>ajouter un offre :</p>

            </div>

             <div class="flex gap-4 my-2">

                <x-mary-button  label="ajouter une offre"  @click="$wire.showFormulaireao = true" class="btn-primary" spinner="save2" />


            </div>
        </div>

    </div>
    
     <x-mary-modal wire:model="showFormulaireao" persistent class="backdrop-blur">

        <livewire:formulaireao>
    </x-mary-modal>
</div>



