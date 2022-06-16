<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('employee');
})->middleware(['auth'])->name('employee');*/

Route::get('/test', [\App\Http\Controllers\TestController::class, 'index'])->name('test.seed');

Route::middleware(['auth'])->group(function ()
{
    Route::get('/employes', [\App\Http\Controllers\EmployesController::class, 'index'])->name('employes');
    Route::get('/employes/{department_id}', [\App\Http\Controllers\DepartmentsController::class, 'index'])->name('employes.department');


    Route::post('/employee/store', [\App\Http\Controllers\EmployesController::class, 'store'])->name('employee.store');
    Route::post('/employee/{id}/update', [\App\Http\Controllers\EmployesController::class, 'update'])->name('employee.update');
    Route::post('/employee/{id}/delete', [\App\Http\Controllers\EmployesController::class, 'destroy'])->name('employee.delete');
    Route::get('/employee/{id}/edit', [\App\Http\Controllers\EmployesController::class, 'edit'])->name('employee.edit');
    Route::get('/employee/create', [\App\Http\Controllers\EmployesController::class, 'create'])->name('employee.create');
    Route::get('/employee/{id}', [\App\Http\Controllers\EmployesController::class, 'show'])->name('employee.show');

    Route::get('/departments', [\App\Http\Controllers\DepartmentsController::class, 'list'])->name('departments');
    Route::get('/department/create', [\App\Http\Controllers\DepartmentsController::class, 'create'])->name('department.create');
    Route::post('/department/store', [\App\Http\Controllers\DepartmentsController::class, 'store'])->name('department.store');
    Route::post('/department/{department_id}/update', [\App\Http\Controllers\DepartmentsController::class, 'update'])->name('department.update');
    Route::get('/department/{department_id}/delete', [\App\Http\Controllers\DepartmentsController::class, 'destroy'])->name('department.destroy');
    Route::get('/department/{department_id}', [\App\Http\Controllers\DepartmentsController::class, 'edit'])->name('department.edit');

    Route::get('/positions', [\App\Http\Controllers\PositionController::class, 'index'])->name('positions');
    Route::get('/position/create', [\App\Http\Controllers\PositionController::class, 'create'])->name('position.create');
    Route::post('/position/store', [\App\Http\Controllers\PositionController::class, 'store'])->name('position.store');
    Route::post('/position/{position_id}/update', [\App\Http\Controllers\PositionController::class, 'update'])->name('position.update');
    Route::get('/position/{position_id}/delete', [\App\Http\Controllers\PositionController::class, 'destroy'])->name('position.destroy');
    Route::get('/position/{position_id}', [\App\Http\Controllers\PositionController::class, 'edit'])->name('position.edit');

    Route::get('/salaries', [\App\Http\Controllers\SalaryController::class, 'index'])->name('salaries');
    Route::get('/salary/create', [\App\Http\Controllers\SalaryController::class, 'create'])->name('salary.create');
    Route::post('/salary/store', [\App\Http\Controllers\SalaryController::class, 'store'])->name('salary.store');
    Route::post('/salary/{salary_id}/update', [\App\Http\Controllers\SalaryController::class, 'update'])->name('salary.update');
    Route::get('/salary/{salary_id}/delete', [\App\Http\Controllers\SalaryController::class, 'destroy'])->name('salary.destroy');
    Route::get('/salary/{salary_id}', [\App\Http\Controllers\SalaryController::class, 'edit'])->name('salary.edit');
});

require __DIR__.'/auth.php';
