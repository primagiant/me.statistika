@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap relative md:pt-32 pb-32 pt-12">
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-700">
                                Datalist Uji T
                            </h3>
                        </div>
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                            <form class="inline" action="{{ route('export.ujit') }}" method="POST">
                                <button
                                    class="bg-amber-500 text-white hover:bg-amber-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="submit">
                                    Export
                                </button>
                                @csrf
                            </form>
                            <button id="importButton"
                                class="bg-lime-500 text-white hover:bg-lime-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                                Import
                            </button>

                            <form onsubmit="return confirm('Apakah anda yakin menghapus semua data?');"
                                class="inline" action="{{ route('truncate.ujit') }}" method="POST">
                                <button
                                    class="bg-red-500 text-white hover:bg-red-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="submit">
                                    Clear
                                </button>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <!-- Projects table -->
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class=" w-12 px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                    #
                                </th>
                                <th
                                    class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                    x1
                                </th>
                                <th
                                    class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                    x2
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ujit as $index => $item)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                        {{ $index + 1 }}
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                        {{ $item->x1 }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                        {{ $item->x2 }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-3 bg-white px-3 rounded-b-lg">
                    {{ $ujit->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Import Modal --}}
    <div class="hidden fixed z-10 inset-0 overflow-y-auto" id="importModal" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <form action="{{ route('import.ujit') }}" method="POST" enctype="multipart/form-data"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Tambah Data
                            </h3>
                            <div class="mt-5">
                                @csrf
                                <input class="w-full rounded-md" type="file" name="file">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Import Data
                    </button>
                    <button id="importModalCancel" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const importButton = document.getElementById('importButton')
        const importModal = document.getElementById('importModal')
        const importModalCancel = document.getElementById('importModalCancel')

        importButton.addEventListener('click', () => {
            if (importModal.classList.contains('hidden')) {
                importModal.classList.remove('hidden');
            } else {
                importModal.classList.add('hidden');
            }
        })

        importModalCancel.addEventListener('click', () => {
            if (importModal.classList.contains('hidden')) {
                importModal.classList.remove('hidden');
            } else {
                importModal.classList.add('hidden');
            }
        })
    </script>
@endsection
