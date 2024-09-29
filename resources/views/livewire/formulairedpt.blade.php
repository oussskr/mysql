<div >

   
    <x-mary-input label="id" wire:model="structure_id" />
    <x-mary-input label="structure" wire:model="structure_designation" />
   
   



        <x-mary-button label="Postuler" class="btn-primary" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save" wire:click='postuler' />
        <x-mary-toast  /> 
        <x-mary-button label="annuler" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;"  spinner="save" wire:click="$dispatch('cancelFormulairedpt')" />
</div>
