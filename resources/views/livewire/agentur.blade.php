

<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Agent détail ') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">




            <!-- Item -->
            <div style="width : 100% ;">

            <div class="w-100 row m-0" style="padding : 5px ; padding-right : 15px ;">
                <div style="display : flex ; align-items : center ; justify-content : space-between ;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($agentur && $agentur->user_id)
                    <x-mary-badge value="Utilisateur" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge-success" />
                    @else
                    <x-mary-badge value="N'est pas un utilisateur" style="min-width : 100px ; font-size : 12px ; color : white"  class="badge bg-red-600 text-white font-bold py-2 px-4 shadow " />
                    @endif
                </div>

                <div class="flex gap-4 my-2">
                <x-mary-dropdown>
                    <x-mary-menu-item title="Bloquer" icon="o-hand-raised" />
                    <x-mary-menu-item title="Archiver" icon="o-archive-box" />
                    <x-mary-menu-item title="Mettre à jour" icon="o-arrow-path" />
                    @if($agentur && $agentur->user_id)
                        <x-mary-menu-item title="Bloquer utilisateur" icon="o-user" />
                        <x-mary-menu-item title="Modifier utilisateur" icon="o-user" />
                        <x-mary-menu-item title="Supprimer utilisateur" icon="o-user" />
                    @else
                        <x-mary-menu-item title="Créer utilisateur" icon="o-user"  @click="$wire.postuler = true"
                        wire:click="$dispatch('setDescreption' , { agenture: {{ $agentur->agent_id }} } )" />
                    @endif
                </x-mary-dropdown>
                </div>
                </div>
            </div>


               <!-- Divider -->
               <div class="border-t border-gray-300 my-4"></div>

               <!-- Content -->
               <div style="width : 100% ; display : flex ; align-items : center ; justify-content : center ; ">
                   <div style="width : 80% ;">

                       <x-mary-card title="{{$agentur->agent_nom.' '.$agentur->agent_prenom}}" subtitle="{{$agentur->agent_addresse}}" shadow separator class="w-full h-full bg-white dark:bg-gray-800" >


                           <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Structure
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->structure_designation}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Fonction
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->fonction_nom}}
                                    </div>
                               </div>



                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Nom
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_nom}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Prénom
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_prenom}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Père
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_prenom_du_pere}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Mère
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_nom_prenom_mere}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Date de naissance
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_date_nais}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Nationalité
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_nationalite}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Marié
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_sf == 1 ? "Oui" : "Non"}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Nbr d'enfants
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_nbr_enfant}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        TEL
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_tel}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Email
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_email}}
                                    </div>
                               </div>



                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Wilaya
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->wilaya_designation}}
                                    </div>
                               </div>



                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Adresse
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->agent_addresse}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        Diplome
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                        {{$agentur->diplome_designation}}
                                    </div>
                               </div>

                               <div class="">
                                    <div style="width : 100% ; font-size : 14px ; color : #7480ff ;  ">
                                        CV
                                    </div>
                                    <div style="width : 100% ; margin-bottom : 15px ; font-size : 14px  ">
                                    <a href="{{(empty($_SERVER['HTTPS']) ? 'http' : 'https') . '://'.$_SERVER['HTTP_HOST'].'/'.$agentur->agent_cv}}"  class="text-gray-100">Download</a>

                                    </div>
                               </div>

                           </div>

                       </x-mary-card>
                                          </div>
               </div>
            </div>




            <div class="agenture_table_div flex w-full  my-4 px-4" >
                <x-mary-table class="w-full" :headers="$tabs_headers" :rows="$tabs" wire:model="expanded" expandable>
                    {{-- Special `expansion` slot --}}
                    @scope('expansion', $tab)
                        <div class=" p-8 font-bold" style="background : #273243 ; border-radius : 20px ;">
                            <div style="width : 100% ; display : flex ; align-items : center ; justify-content : flex-end ;">
                                <x-mary-button
                                label="Ajouter"
                                class="btn-primary"
                                spinner="save2" />

                            </div>
                            <x-mary-table :headers="$tab['headers']" :rows="$tab['rows']"  >

                                @scope('cell_actions', $details_row)
                                    @if($details_row["id"] === 1)
                                        <div class="w-full">
                                            <x-mary-icon name="o-archive-box" class="w-5 h-5" style="cursor : pointer ; margin-right : 10px ;"/>
                                            <x-mary-icon name="o-arrow-path" class="w-5 h-5" style="cursor : pointer ; margin-right : 10px ;"/>
                                            <x-mary-icon name="m-document-arrow-down" class="w-5 h-5" style="cursor : pointer ; margin-right : 10px ;"/>

                                        </div>
                                    @endif
                                @endscope

                            </x-mary-table>
                        </div>
                    @endscope

               </x-mary-table>

            </div>









        </div>

    </div>

    <x-mary-modal wire:model="postuler" persistent class="backdrop-blur">
        <div></div>
            <livewire:formulaireCreateUser>
            <x-mary-button label="Cancel" style="margin : 10px 5px ; width : 100% ; margin-bottom : 20px ;" @click="$wire.postuler = false" />

    </x-mary-modal>
   

</div>



