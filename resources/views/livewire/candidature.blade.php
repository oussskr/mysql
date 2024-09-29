

<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Candidature : ') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-100 row m-0" style="padding : 5px ; padding-right : 15px ;">
                <div style="display : flex ; align-items : center ; justify-content : space-between ;">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($candidature && $candidature->demande_recrutment_statut == "Acceptée")
                        <x-mary-badge :value="$candidature->demande_recrutment_statut" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-success" />
                    @elseif($candidature && $candidature->demande_recrutment_statut == "En cours")
                        <x-mary-badge :value="$candidature->demande_recrutment_statut" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-warning" />
                    @else
                        <x-mary-badge :value="$candidature->demande_recrutment_statut ?? '' " style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-red-600 text-white font-bold py-2 px-4 shadow " />

                    @endif
                    </div>
                    <div class="flex gap-4 my-2">
                        @if($candidature && $candidature->demande_recrutment_statut == "En cours")
                            <x-mary-button  label="Rejeter"   @click="$wire.showFormulaire = true"
                            wire:click="$dispatch('setCandidature' , { id: {{ $candidature->candidat_id }} , action : 'Rejeter' } )" class="btn-danger" class="bg-red-600 text-white font-bold py-2 px-4 shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50" spinner="save2" />
                            <x-mary-button  label="Valider" @click="$wire.showFormulaire = true"
                            wire:click="$dispatch('setCandidature' , { id: {{ $candidature->candidat_id }} , action : 'Valider' } )" class="btn-primary" spinner="save2" />
                        @endif
                    </div>
                </div>
            </div>
            @if($candidature && $candidature->candidat_id )

            @if(count($entretientrows) >0 )
            <!-- Item -->
            <div style="width : 100% ;">
                <!-- Title -->
               <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 px-5">
                   Liste des entretients
               </h1>

               <!-- Divider -->
               <div class="border-t border-gray-300 my-4"></div>

               <!-- Content -->
               <div style="width : 100% ; display : flex ; align-items : center ; justify-content : center ; padding-bottom : 50px ; ">
                   <div style="width : 100% ;">
                    <div class="flex gap-4 my-2 px-5" style="justify-content : flex-end">
                        <x-mary-button label="Définir un autre" class="btn-success"  @click="$wire.showFormulaire = true"
                            wire:click="$dispatch('setCandidature' , { id: {{ $candidature->candidat_id }} , action : 'Changer' } )" />
                    </div>
                        <x-mary-table :headers="$entretientheaders" :rows="$entretientrows" :row-decoration="['bg-green-500 text-white font-bold' => fn($entretientrow) => $entretientrow->row_index  == 1 ]" >

                        </x-mary-table>

                   </div>
               </div>
            </div>

            @endif
            <!-- Item -->
            <div style="width : 100% ;">
                <!-- Title -->
               <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 px-5">
                   Candidature
               </h1>

               <!-- Divider -->
               <div class="border-t border-gray-300 my-4"></div>

               <!-- Content -->
               <div style="width : 100% ; display : flex ; align-items : center ; justify-content : center ; ">
                   <div style="width : 80% ;">
                       <x-mary-card title="{{$candidature->candidat_nom.' '.$candidature->candidat_prenom}}" subtitle="{{$candidature->candidat_addresse}}" shadow separator class="w-full h-full bg-white dark:bg-gray-800" >


                           <div class="grid grid-cols-2 gap-4">
                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Date de la demande
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->demande_recrutment_date}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Adresse
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_addresse}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Nom
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_nom}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Prénom
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_prenom}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Père
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_prenom_du_pere}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Mère
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_nom_prenom_mere}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Date de naissance
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_date_nais}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Nationalité
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_nationalite}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Marié
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_sf == 1 ? "Oui" : "Non"}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Nbr d'enfants
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_nbr_enfant}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        TEL
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_tel}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Email
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->candidat_email}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Diplome
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$candidature->diplome_designation}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        CV
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                    <a href="{{(empty($_SERVER['HTTPS']) ? 'http' : 'https') . '://'.$_SERVER['HTTP_HOST'].'/'.$candidature->candidat_cv}}"  class="text-gray-100">Download</a>

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
                   Offre
               </h1>

               <!-- Divider -->
               <div class="border-t border-gray-300 my-4"></div>

               <!-- Content -->
               <div style="width : 100% ; display : flex ; align-items : center ; justify-content : center ; ">
                   <div style="width : 80% ;">
                       <x-mary-card title="{{$candidature->offre_titre}}" subtitle="{{$candidature->offre_description}}" shadow separator class="w-full h-full bg-white dark:bg-gray-800" >
                           <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                               Compétance requises :
                           </div>
                           <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                               {{$candidature->offre_competences_requises}}
                           </div>

                           <div class="grid grid-cols-2 gap-4">
                               <div class="">
                                   <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                       Type de contrat :
                                   </div>
                                   <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                       {{$candidature->type_contrat_nom}}
                                   </div>
                               </div>
                               <div class="">
                                   <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                       Niveau d'étude :
                                   </div>
                                   <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                       {{$candidature->niveau_etude}}
                                   </div>
                               </div>
                               <div class="">
                                   <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                       Lieu :
                                   </div>
                                   <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                       {{$candidature->wilaya_designation}}
                                   </div>
                               </div>
                               <div class="">
                                   <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                   Date limite :
                                   </div>
                                   <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                   {{$candidature->offre_date_limit_condidature}}

                                   @if($candidature->expire == 1)
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
                       <x-mary-card title="{{$candidature->besoin_recrutment_titre_offre}}" subtitle="{{$candidature->structure_designation}}" shadow separator class="w-full h-full bg-white dark:bg-gray-800" >

                       </x-mary-card>

                   </div>
               </div>
            </div>
            @endif


        </div>

    </div>
   

    <x-mary-modal wire:model="showFormulaire" persistent class="backdrop-blur">
        <livewire:formulairetraitercandidature>
    </x-mary-modal>

</div>



