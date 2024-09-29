<div>






    <x-mary-input label="Titre de l'offre" value="{{$offre->offre_titre ?? ''}}" readonly />
    <x-mary-input label="Description de l'offre" value="{{$descreption}}" readonly />
    <x-mary-input label="Nom" wire:model="nom" />
    <x-mary-input label="Prénom" wire:model="prenom" />
    <x-mary-datetime label="Date de naissance" wire:model="candidat_date_nais" icon="o-calendar" />
    <x-mary-input label="Prénom du père" wire:model="candidat_prenom_du_pere" />
    <x-mary-input label="Nom & prénom de la mère" wire:model="candidat_nom_prenom_mere" />
    <x-mary-input label="Numero de téléphone" wire:model="candidat_tel" />
        <x-mary-input label="Adresse email" wire:model="candidat_email" />
        <x-mary-input label="Diplômes" wire:model="diplome_designation" />

        <x-mary-file wire:model="file" label="Joindre votre CV" hint="Only PDF" accept="application/pdf" />

        {{-- <x-mary-select label="diplome" :options="$diplome_designation" wire:model="diplome_designation" /> --}}


        <x-mary-input label="Nationalité" wire:model="candidat_nationalite" /></br>


        <x-mary-toggle label="Mariée" wire:model="candidat_sf" /></br>


        <x-mary-input label="Nombre d'enfants" wire:model="candidat_nbr_enfant" /></br>



        <x-mary-textarea
         label="Adresse"
        wire:model="candidat_addresse"
        placeholder="votre addresse ..."
        hint="Max 1000 chars"
        rows="5"
        inline />




        <x-mary-button label="Postuler" class="btn-primary" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save" wire:click='postuler' />
        <x-mary-toast  />
</div>
