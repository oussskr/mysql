<div >
    @if($candidature != null )
        <div class="p-6 text-gray-900 dark:text-gray-100">
                @if($candidature && $candidature->demande_recrutment_statut == "Acceptée")
                    <x-mary-badge :value="$candidature->demande_recrutment_statut" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-success" /> 
                @elseif($candidature && $candidature->demande_recrutment_statut == "En cours")
                    <x-mary-badge :value="$candidature->demande_recrutment_statut" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-warning" /> 
                @else
                    <x-mary-badge :value="$candidature->demande_recrutment_statut ?? '' " style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-red-600 text-white font-bold py-2 px-4 shadow " /> 

                @endif
        </div>
        <x-mary-input label="Candidat" value="{{$candidature->candidat_nom.' '.$candidature->candidat_prenom}}" readonly />   
        @if($action == 'Rejeter')
            <div style="margin-top : 50px ; ">
                Vous voulez vraiment rejeter cette candidature ? 
            </div>    

        @elseif($action == 'Valider' || $action == 'Changer')
            <x-mary-datetime label="Date" wire:model="entretien_date" icon="o-calendar" />
            <x-mary-input label="Type" wire:model="entretien_type" />
            <x-mary-input label="Lieu" wire:model="entretien_lieu" />

        @endif


        <div style="width : 100% ; display : flex ; align-items : center ; justify-content : flex-end ; margin-top : 50px ;">
            <x-mary-button label="{{'Valider'}}" class="btn-primary" type="submit" spinner="save" wire:click='postuler' />
            <x-mary-button label="Annuler" class="btn" style="margin-left : 10px ;"  spinner="save" @click="$wire.candidature = null" wire:click="$dispatch('cancelFormulairetraitercandidature')" />

        </div>
    @else
    <div style="width : 100% ; display : flex ; align-items : center ; justify-content : flex-end ; margin-top : 50px ;">
            <x-mary-button label="Annuler" class="btn" style="margin-left : 10px ;"  spinner="save" @click="$wire.candidature = null" wire:click="$dispatch('cancelFormulairetraitercandidature')" />
        </div>

    @endif
    <x-mary-toast  /> 
</div>
