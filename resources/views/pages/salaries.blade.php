<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-light text-gray-500">{{ __('Salaries') }}</span></h2>
            <a href="{{ route('salary.create') }}" class="py-2 px-3 text-white text-sm bg-emerald-500 hover:bg-emerald-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add new Salary
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full mb-5">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-light tracking-wide text-left"></th>
                            <th class="p-3 text-sm font-light tracking-wide text-left">Department</th>
                            <th class="p-3 text-sm font-light tracking-wide text-left">Position</th>
                            <th class="p-3 text-sm font-light tracking-wide text-left">Salary</th>
                            <th class="p-3 text-sm font-light tracking-wide text-left"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($salaries as $salary)
                            <tr class="bg-gray-50 hover:bg-gray-100">
                                <td class="p-3 text-sm text-gray-700">
                                    <div class="text-sm text-gray-500">{{ $loop->index+1 }}</div>
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    <div class="">
                                        <a href="{{ route('department.edit', ['department_id' => $salary->position->department->id]) }}" class="text-sm text-gray-800 hover:text-blue-500 py-2">
                                            {{ $salary->position->department->title }}
                                        </a>
                                    </div>
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    <div class="">
                                        <a href="{{ route('position.edit', ['position_id' =>  $salary->position->department->id]) }}" class="text-sm text-gray-800 hover:text-blue-500 py-2">
                                            {{ $salary->position->title }}
                                        </a>
                                    </div>
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    <div class="">
                                        <a href="{{ route('salary.edit', ['salary_id' => $salary->id]) }}" class="text-sm text-gray-800 hover:text-blue-500 py-2">
                                            {{ $salary->title }}
                                        </a>
                                    </div>
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    <div class="">
                                        {{ $salary->description }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
