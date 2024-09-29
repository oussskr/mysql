<div>






    <x-mary-input label="Structure" value="{{$offre->structure_designation ?? ''}}" readonly />    
    <x-mary-input label="Agent" value="{{$descreption}}" readonly />
    <x-mary-input label="Email"  value="{{$offre->agent_email ?? ''}}" readonly />
    <x-mary-input label="Mot de passe" type="password" wire:model="password" />
    <x-mary-input label="Confirmation mot de passe" type="password" wire:model="password_confirmation" />
    


        <x-mary-button label="Créer" class="btn-primary" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" type="submit" spinner="save" wire:click='postuler' />
        <x-mary-toast  /> 
</div>
