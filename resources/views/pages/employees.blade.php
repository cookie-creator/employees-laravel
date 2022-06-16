<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-light text-gray-500">Employes</h2>
            <a href="{{ route('employee.create') }}" class="py-2 px-3 text-white text-sm bg-emerald-500 hover:bg-emerald-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add new Employee
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow-sm sm:rounded-lg border-b border-gray-200 p-3 lg:px-8 sm:px-6">

            <div class="flex justify-between">
                <div>
                    <span class="text-sm">Department:</span>
                    <select id="department" name="department" class="mt-1 ml-1 inline-block w-100 py-2 px-6 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option @if(!isset($selectedDepartment)) selected @endif value="0">All</option>
                        @foreach($departments as $department)
                            <option
                                @isset($selectedDepartment)
                                    @if($selectedDepartment == $department->id)
                                        selected
                                @endif
                                @endisset
                                value="{{ $department->id }}">{{ $department->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <span class="text-sm">On page:</span>
                    <select id="onpage" name="onpage" class="mt-1 ml-1 inline-block w-20 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option @if($onpage == 10) selected @endif value="10">10</option>
                        <option @if($onpage == 25) selected @endif value="25">25</option>
                        <option @if($onpage == 50) selected @endif value="50">50</option>
                        <option @if($onpage == 100) selected @endif value="100">100</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full mb-5">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-light tracking-wide text-left">No.</th>
                            <th class="p-3 text-sm font-light tracking-wide text-left">Post</th>
                            <th class="p-3 text-sm font-light tracking-wide text-left"></th>
                            <th class="p-3 text-sm font-light tracking-wide text-left">Department</th>
                            <th class="p-3 text-sm font-light tracking-wide text-left">Position</th>
                            <th class="p-3 text-sm font-light tracking-wide text-left">Salary</th>
                            <th class="p-3 text-sm font-light tracking-wide text-left"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr class="bg-gray-50 hover:bg-gray-100">
                                <td class="p-3 text-sm text-gray-700">
                                    <div class="text-sm text-gray-500">{{ $loop->index+1 }}</div>
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    <div class="">
                                        <a href="{{ route('employee.edit', ['id' => $employee->id]) }}" class="text-sm text-gray-800 hover:text-blue-500 py-2">
                                            {{ $employee->fullName }}
                                        </a>
                                    </div>
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    {{ $employee->date }}
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    {{ $employee->department->title }}
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    {{ $employee->position->title }}
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    {{ $employee->employee_salary->amount }}

                                    @if ($employee->employee_salary->salary_types->type == 0) / hour @endif
                                </td>
                                <td class="p-3 text-sm text-gray-700">
                                    <div class="">
                                        <a href="{{ route('employee.delete', ['id' => $employee->id]) }}" class="inline-block w-100 py-1 px-2 text-sm text-white bg-red-500 hover:bg-red-890 rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                         @endforeach
                        </tbody>
                    </table>

                    {{ $employees->links() }}

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function (){
            $('#department').change(function (){
                let department = $(this).find(":selected").val();

                if (department == 0) {
                    window.location = window.location.origin + '/employes';
                    return;
                }

                window.location = window.location.origin + '/employes/' + department;
            });

            $('#onpage').change(function (){
                redirectByParams($(this).find(":selected").val());
            });
        });

        function redirectByParams(onpage)
        {
            let department = $('#department').find(":selected").val();

            if (department == 0) {
                baseUrl = window.location.origin + '/employes';
            } else {
                baseUrl = window.location.origin + '/employes/' + department;
            }

            page = getParams('page');

            if (onpage > 0 && page > 0) {
                baseUrl = baseUrl + '?onpage=' + onpage + '&page=' + page;
            } else if (onpage > 0 && page == null) {
                baseUrl = baseUrl + '?onpage=' + onpage;
            }

            window.location = baseUrl;
        }

        function getParams(key)
        {
            parameterList = new URLSearchParams(window.location.search);

            return parameterList.get(key);
        }
    </script>

</x-app-layout>
