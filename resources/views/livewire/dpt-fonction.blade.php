<div class="bg-gray-100 dark:bg-gray-900 h-screen">
    <div class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Paramètres') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-100 row m-0" style="padding: 5px; padding-right: 15px;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3>Départements</h3>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 my-2">
                <x-mary-input label="" wire:model="recherche" placeholder="Rechercher" clearable wire:keydown.enter="reload"/>
                <x-mary-button label="Afficher" class="btn-success" wire:click="reload" />
                <x-mary-button label="Ajouter" @click="$wire.showFormulairedpt = true" class="btn-primary" spinner="save2" />
            </div>

            <x-mary-table :headers="$dptheaders" :rows="$dpt" striped>
                <x-slot name="row-actions">
                    <!-- 3-point menu -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="w-6 h-6 relative focus:outline-none">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-gray-500 dark:text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-2 2m0 0l-2-2m2 2V5m0 14V5m7 14l-2 2m0 0l-2-2m2 2V5m0 14V5m-14 7l-2 2m0 0l-2-2m2 2h14m0-14H5m2 14V5m0 14V5"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-lg z-10">
                            <x-mary-dropdown wire:click="confirmModify">
                                {{ __('Modify') }}
                            </x-mary-dropdown>
                            <x-mary-dropdown wire:click="confirmDelete">
                                {{ __('Delete') }}
                            </x-mary-dropdown>
                        </div>
                    </div>
                </x-slot>
            </x-mary-table>

            <!-- Fonctions table -->
            <div class="w-100 row m-0" style="padding: 5px; padding-right: 15px;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3>Fonctions</h3>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 my-2">
                <!-- Input for searching Fonctions -->
                <x-mary-input label="" wire:model="recherche" placeholder="Rechercher" clearable wire:keydown.enter="reload"/>
                <!-- Button to reload Fonctions -->
                <x-mary-button label="Afficher" class="btn-success" wire:click="reload" />
                <!-- Button to add new Fonction -->
                <x-mary-button label="Ajouter" @click="$wire.showFormulairefon = true" class="btn-primary" spinner="save2" />
            </div>

            <!-- Table to display Fonctions -->
            <x-mary-table :headers="$fonheaders" :rows="$fon" striped>
                <!-- Row actions for Fonctions -->
                <x-slot name="row-actions">
                    <!-- 3-point menu -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="w-6 h-6 relative focus:outline-none">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-gray-500 dark:text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-2 2m0 0l-2-2m2 2V5m0 14V5m7 14l-2 2m0 0l-2-2m2 2V5m0 14V5m-14 7l-2 2m0 0l-2-2m2 2h14m0-14H5m2 14V5m0 14V5"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-lg z-10">
                            <x-mary-dropdown wire:click="confirmModify">
                                {{ __('Modify') }}
                            </x-mary-dropdown>
                            <x-mary-dropdown wire:click="confirmDelete">
                                {{ __('Delete') }}
                            </x-mary-dropdown>
                        </div>
                    </div>
                </x-slot>
            </x-mary-table>

        </div>
    </div>
    @if ($showAdd)
        <livewire:personal-add />
    @endif
    <!-- Modal for adding/editing Départements -->
    <x-mary-modal wire:model="showFormulairedpt" persistent class="backdrop-blur">
        <livewire:formulairedpt>
    </x-mary-modal>
    <!-- Modal for adding/editing Fonctions -->
    <x-mary-modal wire:model="showFormulairefon" persistent class="backdrop-blur">
        <livewire:formulairefon>
    </x-mary-modal>
    <!-- Confirmation modal for deleting Départements -->
    @if ($confirmingDelete)
        <x-mary-modal wire:model="confirmingDelete" persistent class="backdrop-blur">
            <!-- Delete confirmation modal content goes here -->
        </x-mary-modal>
    @endif
    <!-- Confirmation modal for modifying Départements -->
    @if ($confirmingModify)
        <x-mary-modal wire:model="confirmingModify" persistent class="backdrop-blur">
            <!-- Modify confirmation modal content goes here -->
        </x-mary-modal>
    @endif

</div>


