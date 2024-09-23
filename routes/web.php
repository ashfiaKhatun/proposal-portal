<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('template.auth.page-login');
})->middleware(['guest']);


Route::get('/dashboard',  [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

Route::get('/supervisors',  [SupervisorController::class, 'index'])->middleware(['auth', 'verified'])->name('supervisors.index');
Route::get('/add-new-supervisor',  [SupervisorController::class, 'create'])->middleware(['auth', 'verified'])->name('supervisors.create');
Route::post('/add-new-supervisor',  [SupervisorController::class, 'store'])->middleware(['auth', 'verified'])->name('supervisors.store');
Route::get('/edit-supervisor-{id}',  [SupervisorController::class, 'edit'])->middleware(['auth', 'verified'])->name('supervisors.edit');
Route::put('/update-supervisor-{id}',  [SupervisorController::class, 'update'])->middleware(['auth', 'verified'])->name('supervisors.update');
Route::delete('/delete-supervisor-{id}',  [SupervisorController::class, 'destroy'])->middleware(['auth', 'verified'])->name('supervisors.destroy');

Route::get('/students',  [StudentController::class, 'index'])->middleware(['auth', 'verified'])->name('students.index');
Route::get('/add-new-student',  [StudentController::class, 'create'])->middleware(['auth', 'verified'])->name('students.create');
Route::post('/add-new-student',  [StudentController::class, 'store'])->middleware(['auth', 'verified'])->name('students.store');
Route::get('/edit-student-{id}',  [StudentController::class, 'edit'])->middleware(['auth', 'verified'])->name('students.edit');
Route::put('/update-student-{id}',  [StudentController::class, 'update'])->middleware(['auth', 'verified'])->name('students.update');
Route::delete('/delete-student-{id}',  [StudentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('students.destroy');

Route::get('department-{id}/supervisors', [DepartmentController::class, 'showSupervisors'])->middleware(['auth', 'verified'])->name('departments.supervisors');
Route::get('department-{id}/students', [DepartmentController::class, 'showStudents'])->middleware(['auth', 'verified'])->name('departments.students');

Route::resource('departments', DepartmentController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
