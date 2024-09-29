<div class="bg-gray-100 dark:bg-gray-900 h-screen">
    <div class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Paramètres') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-100 row m-0" style="padding : 5px ; padding-right : 15px ;">
                <div style="display : flex ; align-items : center ; justify-content : space-between ;">
            <div class="p-6 text-gray-900 dark:text-gray-100">
               <h3>Pays et villes :</h3>
            </div>
        </div>
    </div>

            <div class="flex gap-4 my-2">
                <x-mary-input label="" wire:model="recherche" placeholder="Rechercher" clearable wire:keydown.enter="reload"/>
                <x-mary-button label="Afficher" class="btn-success" wire:click="reload" />
            </div>

            <div class="overflow-x-auto">
                <x-mary-table :headers="$headers" :rows="$wilaya" striped @row-click="$event.detail.name" />
            </div>

            <div class="my-4">
                {{ $wilaya->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>
</div>
