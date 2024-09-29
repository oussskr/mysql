<div >

   
    <x-mary-input label="id" wire:model="id" />
    <x-mary-input label="nom" wire:model="nom" />
    <x-mary-input label="email" wire:model="email" />
   
   



        <x-mary-button label="Postuler" class="btn-primary" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save" wire:click='postuler' />
        <x-mary-toast  /> 
        <x-mary-button label="annuler" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;"  spinner="save" wire:click="$dispatch('cancelFormulaireusr')" />
</div>
