<div>






    <x-mary-input label="Structure" value="{{$offre->structure_designation ?? ''}}" readonly />    
    <x-mary-input label="Agent" value="{{$descreption}}" readonly />
    @if($readOnly)
        <x-mary-input label="Demande Titre" value="{{$offre->demande_titre}}" class="mb-3" readonly/>
        
        <x-mary-textarea
                label="Demande Contenu"
                wire:model="contenu"
                placeholder="votre demande ..."
                hint="Max 1000 chars"
                rows="5"
                readonly
                inline />
    @else 
        <x-mary-input label="Demande Titre" wire:model="titre" class="mb-3" />
        <x-mary-textarea
            label="Demande Contenu"
            wire:model="contenu"
            placeholder="votre demande ..."
            hint="Max 1000 chars"
            rows="5"
            inline />

    @endif
    

    @if(auth()->user()->role_id == 1)
        <x-mary-button label="Valider" class="btn-success" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save"  />
        <x-mary-button label="Réfuser" class="btn-danger" class="bg-red-600 text-white font-bold py-2 px-4 shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"  style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save"  />
        <x-mary-button label="Passer comme besoin de récrutrement" class="btn-primary" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save"  />
    @endif
    @if(!$readOnly)
        <x-mary-button label="Créer" class="btn-primary" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save" wire:click='postuler' />
    @endif
    <x-mary-toast  /> 
</div>
