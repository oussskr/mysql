
<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Setting') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
               <h3>pays et ville:</h3>

            </div>
            <x-mary-button  label="ajouter"  wire:click="setShowAdd" class="btn-primary" spinner="save2" />

            <div class="flex gap-4 my-2">
                <x-mary-input label="" wire:model="recherche" placeholder="Clearable field" clearable  wire:keydown.enter="reload"/>
                <x-mary-button label="refrch" class="btn-success"  wire:click="reload" />


            </div>
                            <x-mary-table :headers="$headers" :rows="$wilaya" striped @row-click="$event.detail.name" />


        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h3>dpt et fonction</h3>

         </div>
         <x-mary-button  label="ajouter"  wire:click="setShowAdd" class="btn-primary" spinner="save2" />

         <div class="flex gap-4 my-2">
             <x-mary-input label="" wire:model="recherche" placeholder="Clearable field" clearable  wire:keydown.enter="reload"/>
             <x-mary-button label="refrch" class="btn-success"  wire:click="reload" />


         </div>
                         <x-mary-table :headers="$dptheaders" :rows="$dpt" striped @row-click="$event.detail.name" />


     <div class="p-6 text-gray-900 dark:text-gray-100">
        <h3>diplome</h3>

     </div>
     <x-mary-button  label="ajouter"  wire:click="setShowAdd" class="btn-primary" spinner="save2" />

     <div class="flex gap-4 my-2">
         <x-mary-input label="" wire:model="recherche" placeholder="Clearable field" clearable  wire:keydown.enter="reload"/>
         <x-mary-button label="refrch" class="btn-success"  wire:click="reload" />


     </div>
                     <x-mary-table :headers="$diplomeheaders" :rows="$diplome" striped @row-click="$event.detail.name" />
                     <div class="p-6 text-gray-900 dark:text-gray-100">
    <h3>users</h3>

 </div>
 <x-mary-button  label="ajouter"  wire:click="setShowAdd" class="btn-primary" spinner="save2" />

 <div class="flex gap-4 my-2">
     <x-mary-input label="" wire:model="recherche" placeholder="Clearable field" clearable  wire:keydown.enter="reload"/>
     <x-mary-button label="refrch" class="btn-success"  wire:click="reload" />


 </div>
                 <x-mary-table :headers="$usersheaders" :rows="$users" striped @row-click="$event.detail.name" />


</div>
</div>
</div>
    </div>

</div>
