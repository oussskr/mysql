<div class=" bg-gray-100 dark:bg-gray-900 h-screen">

    <div  class="bg-white dark:bg-gray-800 mt-0 h-20 items-start py-5 pl-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('demmandes') }}
        </h2>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>liste des demmandes:</p></br>
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">


                    <div  class="flex items-start  rounded-lg bg-white p-0
                    shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]
                    ring-1 ring-white/[0.05] transition duration-300
                     hover:text-black/70 hover:ring-black/20
                     focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900
                      dark:ring-zinc-800 dark:hover:text-white/70
                       dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                         <x-mary-card title="Your stats" subtitle="Our findings about you" shadow separator class="w-full h-full">
                             I have title, subtitle, separator and shadow.

                                 <x-mary-button label="Ok" class="btn-primary" />

                         </x-mary-card>


                     </div>


                     <div  class="flex items-start  rounded-lg bg-white p-0
                     shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]
                     ring-1 ring-white/[0.05] transition duration-300
                      hover:text-black/70 hover:ring-black/20
                      focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900
                       dark:ring-zinc-800 dark:hover:text-white/70
                        dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                          <x-mary-card title="Your stats" subtitle="Our findings about you" shadow separator class="w-full h-full">
                              I have title, subtitle, separator and shadow.

                                  <x-mary-button label="Ok" class="btn-primary" />

                          </x-mary-card>


                      </div>


                      <div  class="flex items-start  rounded-lg bg-white p-0
                      shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]
                      ring-1 ring-white/[0.05] transition duration-300
                       hover:text-black/70 hover:ring-black/20
                       focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900
                        dark:ring-zinc-800 dark:hover:text-white/70
                         dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                           <x-mary-card title="Your stats" subtitle="Our findings about you" shadow separator class="w-full h-full">
                               I have title, subtitle, separator and shadow.

                                   <x-mary-button label="Ok" class="btn-primary" />

                           </x-mary-card>


                       </div>



                   <div  class="flex items-start  rounded-lg bg-white p-0
                   shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]
                   ring-1 ring-white/[0.05] transition duration-300
                    hover:text-black/70 hover:ring-black/20
                    focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900
                     dark:ring-zinc-800 dark:hover:text-white/70
                      dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                        <x-mary-card title="Your stats" subtitle="Our findings about you" shadow separator class="w-full h-full">
                            I have title, subtitle, separator and shadow.

                                <x-mary-button label="Ok" class="btn-primary" />

                        </x-mary-card>


                    </div>

                    <div  class="flex items-start  rounded-lg bg-white p-0
                    shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]
                    ring-1 ring-white/[0.05] transition duration-300
                     hover:text-black/70 hover:ring-black/20
                     focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900
                      dark:ring-zinc-800 dark:hover:text-white/70
                       dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                         <x-mary-card title="Your stats" subtitle="Our findings about you" shadow separator class="w-full h-full">
                             I have title, subtitle, separator and shadow.

                                 <x-mary-button label="Ok" class="btn-primary" />

                         </x-mary-card>


                     </div>

                </div>
            </div>


        </div>
    </div>
    @if ($showAdd)

         <livewire:personal-add />
    @endif
</div>




