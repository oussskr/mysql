<div class=" bg-gray-100 dark:bg-gray-900 h-screen">
    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Accueil') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex-col gap-5">
                Entretiens :
               <div class="flex gap-14 my-2 px-16">
                    <x-mary-stat title="Offres en cours" value="{{$data->total_offre}}"   tooltip="Total des offres still en cours"  />
                    <x-mary-stat title="Candidatures" value="{{$data->total_candidat}}"  tooltip="Total candidat come" />
                    <x-mary-stat title="Entretiens" value="{{$data->total_entretien}}"  tooltip="total entretien programé" />
               </div>
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100 flex-col gap-5">
                Statistiques des employés :
               <div class="flex gap-14 my-2 px-16">
                    <x-mary-stat title="Total agents" value="{{$data->total_agent}}"   tooltip="Total Argent dans entreprise"  />
                    <x-mary-stat title="Actif" value="{{$data->actif}}"  tooltip="Total personal active dans l'entreprise" />
                    <x-mary-stat title="Age moyen (actifs)" value="{{$data->Age_moyen_actifs}}"  tooltip="age moiyen de tous les agent actif " />
               </div>
               <div class="flex gap-14 my-4" >
                    <x-mary-stat  title="Hommes" value="{{$data->Hommes}}"  tooltip="totale homme" />
                    <x-mary-stat title="Femmes" value="{{$data->Femmes}}"  tooltip="totale femme" />
                    <x-mary-stat title="Etrangers" value="{{$data->Etrangers}}"  tooltip="totale etreanger" />
                    <x-mary-stat title="Cadres dirigeant" value="{{$data->Cadres_dirigeant}}"  tooltip="totale cadre dirijant" />
               </div>
               <div class="flex gap-14  px-16">
                    <x-mary-stat title="Universitaires" value="{{$data->Universitaires}}"  tooltip="totale universitaires" />
                    <x-mary-stat title="Moy. années experiance" value="{{$data->Moy_annes_experiance}}"  tooltip="moyenne anne experiance dans letablissment" />
                    <x-mary-stat title="Nb. mariées" value="{{$data->Nb_mariees}}"  tooltip="Nombre dagent mariee" />
               </div>
            </div>

            <div class="mt-4">
                   <div class="flex gap-40 justify-center">
                     <div>
                        <x-mary-table :headers="$wilayaheaders" :rows="$wilayarows" striped @row-click="alert($event.detail.name)"  />
                     </div>
                     <div>
                        <x-mary-table :headers="$departementheaders" :rows="$departementrows" striped @row-click="alert($event.detail.name)" />
                     </div>
                   </div>
            </div>
        </div>
    </div>
</div>
