<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\Private\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Private\UserController;
use App\Http\Controllers\Private\LevelController;
use App\Http\Controllers\Private\CourseController;
use App\Http\Controllers\Private\SchoolYearController;
use App\Http\Controllers\TaskController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['role:superadmin|admin']], function () {
        Route::group(['middleware' => ['role:superadmin']], function () {
            Route::resource('levels', LevelController::class)->except('create', 'edit', 'show');
        });

        Route::resource('classrooms', ClassroomController::class)->except('create', 'edit');
        Route::post('classrooms/{classroom}/add-student', [ClassroomController::class, 'addStudent'])->name('classrooms.add-student');
        Route::delete('classrooms/{classroom}/remove-student', [ClassroomController::class, 'removeStudent'])->name('classrooms.remove-student');
        Route::resource('courses', CourseController::class)->except('create', 'edit', 'show');
        Route::resource('school-years', SchoolYearController::class)->except('create', 'edit', 'show');
        Route::resource('users', UserController::class)->except('create', 'edit', 'show');
    });

    Route::get('/learning', [LearningController::class, 'index'])->name('learning.index');
    Route::get('/learning/{classroom}', [LearningController::class, 'show'])->name('learning.show');
    Route::get('/learning/{classroom}/course/{course}', [LearningController::class, 'showCourse'])->name('learning.course.show');

    // Manage Subject
    Route::post('/learning/{classroom}/course/{course}/save-subject', [LearningController::class, 'storeSubject'])->name('learning.course.storeSubject');
    Route::put('/learning/{classroom}/course/{course}/update-subject', [LearningController::class, 'updateSubject'])->name('learning.course.updateSubject');
    Route::delete('/learning/{classroom}/course/{course}/delete-subject', [LearningController::class, 'deleteSubject'])->name('learning.course.deleteSubject');

    Route::get('/subject/file/{id}', [LearningController::class, 'downloadSubject'])->name('subject.file.download');

    // Manage Task
    Route::post('/learning/{classroom}/course/{course}/save-task', [TaskController::class, 'storeTask'])->name('learning.course.storeTask');
    Route::put('/learning/{classroom}/course/{course}/update-task', [TaskController::class, 'updateTask'])->name('learning.course.updateTask');
    Route::delete('/learning/{classroom}/course/{course}/delete-task', [TaskController::class, 'deleteTask'])->name('learning.course.deleteTask');

    Route::get('/task/file/{id}', [TaskController::class, 'downloadTask'])->name('task.file.download');

    // Manage Evaluation
    Route::put('/learning/{classroom}/course/{course}/evaluation-task', [EvaluationController::class, 'evaluationTask'])->name('learning.course.evaluationTask');
    
    Route::get('/evaluation/file/{id}', [EvaluationController::class, 'downloadEvaluation'])->name('evaluation.file.download');

    // Upload Task
    Route::post('/learning/{classroom}/course/{course}/upload-task', [TaskController::class, 'uploadTask'])->name('learning.course.uploadTask');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
