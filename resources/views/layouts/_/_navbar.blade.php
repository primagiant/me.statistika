<nav
    class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
    <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
        <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
            href="{{ route('dashboard') }}">Dashboard</a>
        <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
            <div class="text-gray-500 block">
                <div class="items-center flex">
                    <span
                        class="w-12 h-12 text-sm text-white bg-gray-200 inline-flex items-center justify-center rounded-full">
                        <img alt="..." class="w-full rounded-full align-middle border-none shadow-lg"
                            src="{{ asset('img/team-1-800x800.jpg') }}" />
                    </span>
                </div>
            </div>
        </ul>
    </div>
</nav>
