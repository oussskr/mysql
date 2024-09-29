<div >
    @if($offre != null )
    <x-mary-input label="Titre de l'offre" value="{{$offre->offre_titre ?? ''}}" readonly />   

        <div style="margin-top : 50px ; ">
            Vous voulez vraiment {{$offre->bloque == 1 ? 'activer ' : 'bloquer '}}  cette offre ? 
        </div>    


        <div style="width : 100% ; display : flex ; align-items : center ; justify-content : flex-end ; margin-top : 50px ;">
            <x-mary-button label="{{$offre->bloque == 1 ? 'Activer' : 'Bloquer'}}" class="btn-primary" type="submit" spinner="save" wire:click='postuler' />
            <x-mary-button label="Annuler" class="btn" style="margin-left : 10px ;"  spinner="save" @click="$wire.offre = null" wire:click="$dispatch('cancelFormulaireoffrebloque')" />

        </div>
    @else
    <div style="width : 100% ; display : flex ; align-items : center ; justify-content : flex-end ; margin-top : 50px ;">
            <x-mary-button label="Annuler" class="btn" style="margin-left : 10px ;"  spinner="save" @click="$wire.offre = null" wire:click="$dispatch('cancelFormulaireoffrebloque')" />
        </div>

    @endif
    <x-mary-toast  /> 
</div>
