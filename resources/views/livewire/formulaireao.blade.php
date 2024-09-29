<div >

    <x-mary-choices
            label="Besoin de recructement"
            wire:model="besoin_recrutment"
            :options="$besoins"
            search-function="searchBesoin"
            searchable
            no-result-text="Ops! Nothing here ..."
            single
            />
    <x-mary-input label="offre_titre" wire:model="offre_titre" />
 <x-mary-datetime label="offre_date_limit_condidature" wire:model="offre_date_limit_condidature" icon="o-calendar" />
 <x-mary-input label="offre_nbr_postes" wire:model="offre_nbr_postes" />
 <x-mary-input label="niveau_etude" wire:model="niveau_etude" />
 <x-mary-input label="offre_description" wire:model="offre_description" />
 {{-- <x-mary-input label="offre_lieu" wire:model="offre_lieu" />--}}

 <x-mary-choices
    label="Lieu"
    wire:model="offre_lieu"
    :options="$wilayas"
    search-function="searchWilaya"
    searchable
    no-result-text="Ops! Nothing here ..."
    single
     />
 <x-mary-input label="offre_competences_requises" wire:model="offre_competences_requises" />


   
    <!-- Combo Box -->
        <x-mary-choices
        label="Contrat"
        wire:model="offre_type_contrat"
        :options="$contrats"
        search-function="searchContract"
        searchable
        no-result-text="Ops! Nothing here ..."
        single
        />


        <div style="width : 100% ; display : flex ; align-items : center ; justify-content : flex-end ; margin-top : 50px ;">
            <x-mary-button label="ajouter" class="btn-primary" type="submit" spinner="save" wire:click='postuler' />
            <x-mary-button label="annuler" class="btn" style="margin-left : 10px ;"  spinner="save" wire:click="$dispatch('cancelFormulaireao')" />

        </div>
</div>
