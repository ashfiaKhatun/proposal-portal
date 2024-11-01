<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
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

Route::get('/admins',  [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('admins.index');

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

Route::get('department-{id}/new-admin', [DepartmentController::class, 'createAdmin'])->middleware(['auth', 'verified'])->name('departments.createAdmin');

Route::post('department-{id}/new-admin', [DepartmentController::class, 'storeAdmin'])->middleware(['auth', 'verified'])->name('departments.storeAdmin');

Route::resource('departments', DepartmentController::class);

Route::get('/proposal',  [ProposalController::class, 'create'])->middleware(['auth', 'verified'])->name('proposals.create');
Route::post('/submit-proposal',  [ProposalController::class, 'store'])->middleware(['auth', 'verified'])->name('proposals.store');
Route::get('/edit-proposal-{id}',  [ProposalController::class, 'edit'])->middleware(['auth', 'verified'])->name('proposals.edit');
Route::put('/edit-proposal-{id}',  [ProposalController::class, 'update'])->middleware(['auth', 'verified'])->name('proposals.update');
// View all proposals
Route::get('/thesis-proposals', [ProposalController::class, 'indexThesis'])->middleware(['auth', 'verified'])->name('proposals.indexThesis');
Route::get('/project-proposals', [ProposalController::class, 'indexProject'])->middleware(['auth', 'verified'])->name('proposals.indexProject');
Route::get('/show-proposal-{id}', [ProposalController::class, 'show'])->middleware(['auth', 'verified'])->name('proposals.show');

// Routes for teacher-specific thesis and project proposals
Route::get('/supervisor-thesis-proposals', [ProposalController::class, 'indexSupervisorThesisProposals'])->middleware(['auth', 'verified'])->name('supervisor.proposals.thesis');
Route::get('/supervisor-project-proposals', [ProposalController::class, 'indexSupervisorProjectProposals'])->middleware(['auth', 'verified'])->name('supervisor.proposals.project');


// Update proposal status
Route::put('/update-status-{id}', [ProposalController::class, 'updateStatus'])->middleware(['auth', 'verified'])->name('proposals.updateStatus');

// Assign supervisor
Route::put('/assign-teacher-proposal-{id}', [ProposalController::class, 'assignTeacher'])->middleware(['auth', 'verified'])->name('proposals.assignTeacher');

// Provide feedback
// Route for submitting feedback
Route::post('/feedback-proposals-{id}', [ProposalController::class, 'giveFeedback'])->name('proposals.giveFeedback');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
