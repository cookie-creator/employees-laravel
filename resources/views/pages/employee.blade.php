<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-light text-gray-500">Employee: <span>{{$employee->fullName}}</span></h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('employee.update', ['employee_id' => $employee->id]) }}">
                        {{ csrf_field() }}
                        <div class="grid grid-cols-12 gap-10">
                            <div class="col-span-6">
                                <div class="mb-5">
                                    <label for="firstname" class="block text-md font-bold text-gray-700">First name</label>
                                    <input type="text" name="firstname" id="firstname" value="{{ $employee->firstname }}" autocomplete="firstname" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>
                                @error('firstname')
                                    <div class="text-sm text-red-500 py-1">{{ $message }}</div>
                                @enderror

                                <div class="mb-5">
                                    <label for="surname" class="block text-md font-bold text-gray-700">Surname</label>
                                    <input type="text" name="surname" id="surname" value="{{ $employee->surname }}" autocomplete="surname" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>
                                @error('surname')
                                    <div class="text-sm text-red-500 py-1">{{ $message }}</div>
                                @enderror

                                <div class="mb-5">
                                    <label for="lastname" class="block text-md font-bold text-gray-700">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" value="{{ $employee->lastname }}" autocomplete="lastname" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>
                                @error('lastname')
                                    <div class="text-sm text-red-500 py-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <div class="text-md text-red-500 py-1">You can remove this Employee</div>
                                <a href="{{ route('employee.destroy', ['employee_id' => $employee->id]) }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2">
                                    Delete
                                </a>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="date" class="block text-md font-bold text-gray-700">Date of birth</label>
                            <div class="col-span-6 sm:col-span-3">
                                <div class="flex">
                                    <div class="pr-2">
                                        <select id="day" name="day" autocomplete="day" class="mt-1 w-20 inline-block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option @if($employee->day == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="pr-2">
                                        <select id="month" name="month" autocomplete="month" class="mt-1 w-20 inline-block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option @if($employee->month == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div>
                                        <select id="year" name="year" autocomplete="year" class="mt-1 w-20 inline-block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @for ($i = 1900; $i <= 2022; $i++)
                                                <option @if($employee->year == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="department" class="block text-md font-bold text-gray-700">Department</label>
                            <select id="department" name="department" autocomplete="department" class="mt-1 block w-50 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($departments as $department)
                                    <option @if($department->id == $employee->department->id) selected @endif value="{{$department->id}}">{{$department->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label for="position" class="block text-md font-bold text-gray-700">Position</label>
                            <select id="position" name="position" autocomplete="position" class="mt-1 block w-50 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($positions as $position)
                                    @if ($position->department->id == $employee->department->id)
                                        <option @if($position->id == $employee->position->id) selected @endif value="{{$position->id}}">{{$position->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label for="salary" class="block text-md font-bold text-gray-700">Salary</label>
                            <select id="salary" name="salary" autocomplete="salary" class="mt-1 inline-block w-50 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($salaries as $salary)
                                    @if ($salary->position->id == $employee->position->id)
                                        <option @if($salary->id == $employee->salary->id) selected @endif value="{{$salary->id}}">{{$salary->title}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <select id="salaryType" name="salaryType" autocomplete="salaryType" class="mt-1 inline-block  w-50 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($salaryTypes as $type)
                                    <option @if($type->id == $employee->employee_salary->salary_types->id) selected @endif value="{{$type->id}}">{{$type->title}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="salaryAmount" id="salaryAmount" value="{{ $employee->employee_salary->amount }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 ineline-block shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            @error('salaryAmount')
                                <div class="text-sm text-red-500 py-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-left">
                            <button type="submit" class="inline-flex justify-start py-2 px-4 mr-5 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>

                            <a href="{{ route('employees') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){

            let departments = {!! $departments !!};
            let positions = {!! $positions !!};
            let salaries = {!! $salaries !!};

            let DepartmentPlugin = {
                selected : {
                    department : 0,
                    position : 0,
                    salary : 0,
                    salaryType : 0
                },
                elms: {},
                init : function ()
                {
                    let _this = this;
                    this.elms.$department = $('#department');
                    this.elms.$position = $('#position');
                    this.elms.$salary = $('#salary');
                    this.elms.$salariesType = $('#salariesType');

                    this.selected.department = this.elms.$department.find(":selected").val();
                    this.selected.position = this.elms.$position.find(":selected").val();
                    this.selected.salary = this.elms.$salary.find(":selected").val();
                    this.selected.salaryType = this.elms.$salariesType.find(":selected").val();

                    this.elms.$department.change(function() {
                        _this.selected.department = _this.elms.$department.find(":selected").val();

                        _this.elms.$position.html("");
                        positions.forEach(function (item) {
                            if (item.department_id == _this.selected.department)
                            {
                                _this.elms.$position.append($('<option>', {
                                    value: item.id,
                                    text: item.title
                                }));
                            }
                        });

                        _this.selected.position = _this.elms.$position.find('option')[0].value;

                        _this.elms.$salary.html("");
                        salaries.forEach(function (item) {
                            if (item.position_id == _this.selected.position)
                            {
                                _this.elms.$salary.append($('<option>', {
                                    value: item.id,
                                    text: item.title
                                }));
                            }
                        });

                        _this.selected.salary = _this.elms.$salary.find('option')[0].value;
                    });

                    this.elms.$position.change(function() {
                        _this.selected.position = _this.elms.$position.find(":selected").val();

                        _this.elms.$salary.html("");
                        salaries.forEach(function (item) {
                            if (item.position_id == _this.selected.position)
                            {
                                _this.elms.$salary.append($('<option>', {
                                    value: item.id,
                                    text: item.title
                                }));
                            }
                        });

                        _this.selected.salary = _this.elms.$salary.find('option')[0].value;
                    });
                }
            };

            DepartmentPlugin.init();
        });
    </script>

</x-app-layout>
