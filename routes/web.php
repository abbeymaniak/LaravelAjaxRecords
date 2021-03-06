<?php

use App\Http\Controllers\StudentsController;
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

Route::get('/students', [StudentsController::class, 'index']);
Route::get('/fetch-students', [StudentsController::class, 'fetchStudents']);
Route::post('students', [StudentsController::class, 'store']);
Route::get('/edit-student/{id}', [StudentsController::class, 'edit']);
Route::put('/update-student/{id}', [StudentsController::class, 'update']);
Route::delete('/delete-student/{id}', [StudentsController::class, 'destroy']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');