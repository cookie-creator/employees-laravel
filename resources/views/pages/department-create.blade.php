<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-light text-gray-500">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-light text-gray-500">Create new Department</h2>
            </div>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

            <form method="POST" action="{{ route('department.store') }}">
                {{ csrf_field() }}

                <div class="grid grid-cols-12 gap-10">
                    <div class="col-span-6">
                        <div class="mb-5">
                            <label for="title" class="block text-md font-bold text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="" autocomplete="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>
                        @error('title')
                            <div class="text-sm text-red-500 py-1">{{ $message }}</div>
                        @enderror

                        <div class="mb-5">
                            <label for="description" class="block text-md font-bold text-gray-700">Description</label>
                            <input type="text" name="description" id="description" value="" autocomplete="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>
                        @error('description')
                            <div class="text-sm text-red-500 py-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="inline-flex justify-start py-2 px-4 mr-5 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>

                    <a href="{{ route('departments') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2">
                        Cancel
                    </a>
                </div>
            </form>



                </div>
            </div>

        </div>
    </div>
</x-app-layout>
