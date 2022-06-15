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

    Route::get('/departments', [\App\Http\Controllers\DepartmentsController::class, 'index'])->name('departments');
    Route::get('/positions', [\App\Http\Controllers\PositionController::class, 'index'])->name('positions');
    Route::get('/salaries', [\App\Http\Controllers\SalaryController::class, 'index'])->name('salaries');

});

require __DIR__.'/auth.php';
