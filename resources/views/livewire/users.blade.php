
<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Paramètres') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-100 row m-0" style="padding : 5px ; padding-right : 15px ;">
                <div style="display : flex ; align-items : center ; justify-content : space-between ;">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3>Utilisateurs</h3>

            </div>
                </div>
            </div>

            <div class="flex gap-4 my-2">
                <x-mary-input label="" wire:model="recherche" placeholder=" Rechercher" clearable  wire:keydown.enter="reload"/>
                <x-mary-button label="Afficher" class="btn-success"  wire:click="reload" />
                <x-mary-button  label="Ajouter"   @click="$wire.showFormulaireusr = true" class="btn-primary" spinner="save2" />

            </div>
                            <x-mary-table :headers="$usersheaders" :rows="$users" striped @row-click="$event.detail.name" />


</div>
</div>
@if ($showAdd)
<livewire:personal-add />
@endif
<x-mary-modal wire:model="showFormulaireusr" persistent class="backdrop-blur">
        <livewire:formulaireusr>


</x-mary-modal>
    </div>

