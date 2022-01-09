<nav
    class="bg-white md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div
        class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="md:block text-left md:pb-2 text-gray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
            href="{{ route('dashboard') }}">
            {{ config('app.name') }}
        </a>
        <ul class="md:hidden items-center flex flex-wrap list-none">
            <li class="inline-block relative">
                <a class="text-gray-500 block" href="#pablo">
                    <div class="items-center flex">
                        <span
                            class="w-12 h-12 text-sm text-white bg-gray-200 inline-flex items-center justify-center rounded-full">
                            <img alt="..." class="w-full rounded-full align-middle border-none shadow-lg"
                                src="{{ asset('img/team-1-800x800.jpg') }}" />
                        </span>
                    </div>
                </a>
            </li>
        </ul>
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-gray-200">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-gray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                            href="{{ route('dashboard') }}">
                            {{ config('app.name') }}
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button"
                            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                            onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="mb-4 md:min-w-full" />
            <!-- Heading -->
            <h6 class="md:min-w-full text-gray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Tabel Statistik
            </h6>
            <!-- Navigation -->
            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-xs uppercase py-3 font-bold block {{ Route::is('dashboard') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }} ">
                        <i
                            class="fas fa-tv mr-2 text-sm {{ Route::is('about') ? 'opacity-75' : 'text-gray-300' }}"></i>
                        Dashboard
                    </a>
                </li>
                <li class="items-center">
                    <a href="{{ route('about') }}"
                        class="text-xs uppercase py-3 font-bold block {{ Route::is('about') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }} ">
                        <i
                            class="fas fa-user mr-4 text-sm {{ Route::is('about') ? 'opacity-75' : 'text-gray-300' }}"></i>
                        About
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Heading -->
            <h6 class="md:min-w-full text-gray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Datalist
            </h6>

            <!-- Navigation -->
            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route('datalist.skor') }}"
                        class="text-xs uppercase py-3 font-bold block {{ Route::is('datalist.skor') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }} ">
                        <i
                            class="fas fa-tv mr-2 text-sm {{ Route::is('datalist.skor') ? 'opacity-75' : 'text-gray-300' }}"></i>
                        Skor
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('datalist.moment') }}"
                        class="text-xs uppercase py-3 font-bold block {{ Route::is('datalist.moment') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }} ">
                        <i
                            class="fas fa-tools mr-2 text-sm {{ Route::is('datalist.moment') ? 'opacity-75' : 'text-gray-300' }}"></i>
                        Product Moment
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('datalist.ujit') }}"
                        class="text-xs uppercase py-3 font-bold block {{ Route::is('datalist.ujit') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }} ">
                        <i
                            class="fas fa-table mr-2 text-sm {{ Route::is('datalist.ujit') ? 'opacity-75' : 'text-gray-300' }}"></i>
                        Uji T
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('datalist.anava') }}"
                        class="text-xs uppercase py-3 font-bold block {{ Route::is('datalist.anava') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }} ">
                        <i
                            class="fas fa-map-marked mr-2 text-sm {{ Route::is('datalist.anava') ? 'opacity-75' : 'text-gray-300' }}"></i>
                        Uji Anava
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Heading -->
            <h6 class="md:min-w-full text-gray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Tabel Statistik
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                <li class="items-center">
                    <a href="{{ route('statistika.frequensi') }}"
                        class="{{ Route::is('statistika.frequensi') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-fingerprint {{ Route::is('statistika.frequensi') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Frekuensi
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('statistika.bergolong') }}"
                        class="{{ Route::is('statistika.bergolong') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-clipboard-list {{ Route::is('statistika.bergolong') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Bergolong
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('statistika.chi') }}"
                        class="{{ Route::is('statistika.chi') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-clipboard-list {{ Route::is('statistika.chi') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Chi Kuadrat
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('statistika.lilliefors') }}"
                        class="{{ Route::is('statistika.lilliefors') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-clipboard-list {{ Route::is('statistika.lilliefors') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Lilliefors
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('statistika.moment') }}"
                        class="{{ Route::is('statistika.moment') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-clipboard-list {{ Route::is('statistika.moment') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Produk Moment
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('statistika.ujit') }}"
                        class="{{ Route::is('statistika.ujit') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-clipboard-list {{ Route::is('statistika.ujit') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Uji T
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('statistika.anava') }}"
                        class="{{ Route::is('statistika.anava') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-clipboard-list {{ Route::is('statistika.anava') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Uji Anava
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Heading -->
            <h6 class="md:min-w-full text-gray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Options
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                <li class="items-center">
                    <a href="{{ route('options.export') }}"
                        class="{{ Route::is('options.export') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-newspaper {{ Route::is('options.export') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Export
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('options.import') }}"
                        class="{{ Route::is('options.import') ? 'text-cyan-500 hover:text-cyan-600' : 'text-gray-500 hover:text-gray-700' }}  text-xs uppercase py-3 font-bold block">
                        <i
                            class="fas fa-user-circle {{ Route::is('options.import') ? 'opacity-75' : 'text-gray-300' }} mr-2 text-sm"></i>
                        Import
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
