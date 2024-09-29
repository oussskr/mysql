<div >


    <x-mary-input label="Nom" wire:model="nom" />
    <x-mary-input label="Prénom" wire:model="prenom" />
    <x-mary-input label="matricule" wire:model="matricule" />
    <x-mary-datetime label="Date de naissance" wire:model="agent_date_nais" icon="o-calendar" />
    <x-mary-input label="Prénom du père" wire:model="agent_prenom_du_pere" />
    <x-mary-input label="Nom & prénom de la mère" wire:model="agent_nom_prenom_mere" />
    <x-mary-input label="agent_group_sanguin" wire:model="agent_group_sanguin" />
    <x-mary-input label="agent_cni" wire:model="agent_cni" />
    <x-mary-input label="agent_numero_securite_sociale" wire:model="agent_numero_securite_sociale" />
    <x-mary-input label="Email" wire:model="agent_email" /></br>
    <x-mary-input label="Numero de téléphone" wire:model="agent_tel" /></br>


    <x-mary-choices
    label="Structure"
    wire:model="structure_id"
    :options="$structure"
    search-function="searchstructure"
    searchable
    no-result-text="Ops! Nothing here ..."
    single
    />



    <x-mary-choices
    label="Fonction"
    wire:model="fonction_id"
    :options="$fonction"
    search-function="searchfonction"
    searchable
    no-result-text="Ops! Nothing here ..."
    single
    /></br>


    {{-- <x-mary-input label="fonction_nom" wire:model="fonction_nom" /></br> --}}



        <x-mary-toggle label="Femme?" wire:model="agent_genre" /></br>


        <x-mary-choices
    label="wilaya"
    wire:model="wilaya_id"
    :options="$wilaya"
    search-function="searchWilaya"
    searchable
    no-result-text="Ops! Nothing here ..."
    single
     />



     <x-mary-choices
    label="diplome"
    wire:model="diplome_id"
    :options="$diplome"
    search-function="searchDiplome"
    searchable
    no-result-text="Ops! Nothing here ..."
    single
     />

        <x-mary-file wire:model="file" label="Joindre CV" hint="Only PDF" accept="application/pdf" />


        {{-- <x-mary-select label="diplome" :options="$diplome_designation" wire:model="diplome_designation" /> --}}


        <x-mary-input label="Nationalité" wire:model="agent_nationalite" /></br>


        <x-mary-toggle label="Mariée" wire:model="agent_sf" /></br>


        <x-mary-input label="Nombre d'enfants" wire:model="agent_nbr_enfant" /></br>



        <x-mary-textarea
         label="Adresse"
        wire:model="agent_addresse"
        placeholder="votre addresse ..."
        hint="Max 1000 chars"
        rows="5"
        inline />
        <!-- <div>

            {{
                $testing_data
            }}
        </div> -->


        <x-mary-button label="Ajouter" class="btn-primary" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save" wire:click='postuler' />
        <x-mary-toast  />
        <x-mary-button label="annuler" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;"  spinner="save" wire:click="$dispatch('cancelFormulaireae')" />
</div>
