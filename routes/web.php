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
    Route::get('/employes/{department}', [\App\Http\Controllers\EmployesController::class, 'department'])->name('employes.department');

    Route::get('/employee/{id}', [\App\Http\Controllers\EmployesController::class, 'show'])->name('employee.show');
    Route::get('/employee/{id}/edit', [\App\Http\Controllers\EmployesController::class, 'show'])->name('employee.edit');
    Route::post('/employee/{id}/update', [\App\Http\Controllers\EmployesController::class, 'show'])->name('employee.update');
    Route::get('/employee/create', [\App\Http\Controllers\EmployesController::class, 'show'])->name('employee.create');
    Route::post('/employee/store', [\App\Http\Controllers\EmployesController::class, 'show'])->name('employee.store');

    Route::get('/departments', [\App\Http\Controllers\DepartmentsController::class, 'index'])->name('departments');
    Route::get('/positions', [\App\Http\Controllers\PositionController::class, 'index'])->name('positions');
    Route::get('/salaries', [\App\Http\Controllers\SalaryController::class, 'index'])->name('salaries');

});

require __DIR__.'/auth.php';
