<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-light text-gray-500">Data</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="grid grid-cols-12 gap-10">
                        <div class="col-span-6">

                            @if(isset($imported))
                                @if($imported)
                                    <div class="mb-5">
                                        <span class="block text-md font-bold text-gray-700 mb-2">Data successfully imported</span>
                                    </div>
                                @else
                                    <div class="mb-5">
                                        <span class="block text-md font-bold text-gray-700 mb-2">Data was not imported</span>
                                    </div>
                                @endif
                            @endif

                            @if(isset($path_to_xml))
                                <div class="mb-5">
                                    <span class="block text-md font-bold text-gray-700 mb-2">Database was exported you can <a class="text-indigo-600" href="{{ $path_to_xml }}">download it</a></span>
                                </div>
                            @else
                                <div class="mb-5">
                                    <div class="block text-md font-bold text-gray-700 mb-2">You can expoort all data</div>
                                    <a href="{{ route('data.export') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2">
                                        Create XML
                                    </a>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('data.import') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="mb-5">
                                    <label for="firstname" class="block text-md font-bold text-gray-700">Import XML</label>
                                </div>
                                <div class="mt-1 mb-5 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file" class="text-center cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Import XML</span>
                                                <input id="file" name="file" type="file" class="sr-only" />
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-left">
                                    <button type="submit" class="inline-flex justify-start py-2 px-4 mr-5 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Import</button>

                                    <a href="{{ route('employees') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
