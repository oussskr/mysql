

<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Offre : ') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-100 row m-0" style="padding : 5px ; padding-right : 15px ;">
                <div style="display : flex ; align-items : center ; justify-content : space-between ;">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($offre->bloque == 0)
                        <x-mary-badge value="Active" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-success" />
                    @else
                        <x-mary-badge value="Bloqué" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-red-600 text-white font-bold py-2 px-4 shadow " />

                    @endif
                    </div>
                    <div class="flex gap-4 my-2">
                        @if($offre->bloque == 0)
                            <x-mary-button  label="Bloquer"  @click="$wire.showBloquer = true"
                            wire:click="$dispatch('setOffre' , { id: {{ $offre->offre_id }} } )"
                             class="btn-danger" class="bg-red-600 text-white font-bold py-2 px-4 shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50" spinner="save2" />
                        @else
                            <x-mary-button  label="Activer"   @click="$wire.showBloquer = true"
                            wire:click="$dispatch('setOffre' , { id: {{ $offre->offre_id }} } )" class="btn-primary" spinner="save2" />
                        @endif
                    </div>
                </div>
            </div>
            @if($offre && $offre->offre_id )
            <!-- Item -->
            <div style="width : 100% ;">
                <!-- Title -->
               <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 px-5">
                   Offre
               </h1>

               <!-- Divider -->
               <div class="border-t border-gray-300 my-4"></div>

               <!-- Content -->
               <div style="width : 100% ; display : flex ; align-items : center ; justify-content : center ; ">
                   <div style="width : 80% ;">
                       <x-mary-card title="{{$offre->offre_titre}}" subtitle="{{$offre->offre_description}}" shadow separator class="w-full h-full bg-white dark:bg-gray-800" >
                           <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                               Compétance requises :
                           </div>
                           <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                               {{$offre->offre_competences_requises}}
                           </div>

                           <div class="grid grid-cols-2 gap-4">
                               <div class="">
                                   <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                       Type de contrat :
                                   </div>
                                   <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                       {{$offre->type_contrat_nom}}
                                   </div>
                               </div>
                               <div class="">
                                   <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                       Niveau d'étude :
                                   </div>
                                   <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                       {{$offre->niveau_etude}}
                                   </div>
                               </div>
                               <div class="">
                                   <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                       Lieu :
                                   </div>
                                   <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                       {{$offre->wilaya_designation}}
                                   </div>
                               </div>
                               <div class="">
                                   <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                   Date limite :
                                   </div>
                                   <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                   {{$offre->offre_date_limit_condidature}}

                                   @if($offre->expire == 1)
                                   <x-mary-badge value="Expiré" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-red-600 text-white font-bold py-2 px-4 shadow " />

                                   @else
                                   <x-mary-badge value="Active" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-green-600 text-white font-bold py-2 px-4 shadow " />

                                   @endif
                                   </div>
                               </div>
                           </div>

                       </x-mary-card>

                   </div>
               </div>
            </div>

            <!-- Item -->
            <div style="width : 100% ;">
                <!-- Title -->
               <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 px-5">
                Besoin de récrutement
               </h1>

               <!-- Divider -->
               <div class="border-t border-gray-300 my-4"></div>

               <!-- Content -->
               <div style="width : 100% ; display : flex ; align-items : center ; justify-content : center ; ">
                   <div style="width : 80% ;">
                       <x-mary-card title="{{$offre->besoin_recrutment_titre_offre}}" subtitle="{{$offre->structure_designation}}" shadow separator class="w-full h-full bg-white dark:bg-gray-800" >

                       </x-mary-card>

                   </div>
               </div>
            </div>

            <!-- Item -->
            <div style="width : 100% ;">
                <!-- Title -->
               <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 px-5">
                   Liste des Candidatures
               </h1>

               <!-- Divider -->
               <div class="border-t border-gray-300 my-4"></div>

               <!-- Content -->
               <div style="width : 100% ; display : flex ; align-items : center ; justify-content : center ; padding-bottom : 50px ; ">
                   <div style="width : 100% ;">
                    <div class="flex gap-4 my-2 px-5" style="justify-content : flex-end">
                        <x-mary-input label="" wire:model="recherche" placeholder="Rechercher" clearable  wire:keydown.enter="reload"/>
                        <x-mary-button label="Afficher" class="btn-success"  wire:click="reload" />
                    </div>


                        <x-mary-table :headers="$canheaders" :rows="$canrows" :sort-by=$sortBy   link="/candidature/{candidat_id}">
                            @scope('cell_etat', $offrow)
                                @if($offrow->demande_recrutment_statut == "Acceptée")
                                    <x-mary-badge :value="$offrow->demande_recrutment_statut" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-success" />
                                @elseif($offrow->demande_recrutment_statut == "En cours")
                                    <x-mary-badge :value="$offrow->demande_recrutment_statut" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-warning" />
                                @else
                                    <x-mary-badge :value="$offrow->demande_recrutment_statut" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-red-600 text-white font-bold py-2 px-4 shadow " />

                                @endif
                            @endscope
                            @scope('cell_entretient', $offrow)
                            @if($offrow->demande_recrutment_statut == "Acceptée")
                                <x-mary-badge :value="$offrow->entretien_date" class="badge-success" />
                            @else
                                <x-mary-badge value="--" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-dark" />
                            @endif
                            @endscope
                            @scope('cell_actions', $offrow)
                            {{--  <x-badge :value="$user->city->name" class="badge-primary" /> --}}
                                <x-mary-dropdown>
                                    <x-mary-menu-item title="Détails du candidature"  />
                                    <x-mary-menu-item title="Répondre"  />
                                </x-mary-dropdown>
                            @endscope
                        </x-mary-table>

                   </div>
               </div>
            </div>

            @endif


        </div>

    </div>

    <x-mary-modal wire:model="showBloquer" persistent class="backdrop-blur">
        <livewire:formulaireoffrebloque>
    </x-mary-modal>

</div>



