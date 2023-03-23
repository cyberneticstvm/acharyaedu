<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectLevelController;
use App\Http\Controllers\QuestionController;

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
    return view('index');
})->name('index');

Route::get('/message', function () {
    return view('message');
})->name('message');

Route::get('/register', [StudentController::class, 'index'])->name('register');
Route::post('/register', [StudentController::class, 'store'])->name('student.save');
Route::get('/signin', [StudentController::class, 'show'])->name('signin.show');
Route::post('/signin', [StudentController::class, 'signin'])->name('signin');
Route::get('/logout', [StudentController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['web', 'auth', 'admin']], function(){
    Route::get('/admin/dash', [AdminController::class, 'dash'])->name('admin.dash');

    Route::get('/admin/subject', [SubjectController::class, 'index'])->name('subject');
    Route::get('/admin/subject/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/admin/subject/create', [SubjectController::class, 'store'])->name('subject.save');
    Route::get('/admin/subject/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
    Route::put('/admin/subject/edit/{id}', [SubjectController::class, 'update'])->name('subject.update');
    Route::delete('/admin/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.delete');

    Route::get('/admin/level', [SubjectLevelController::class, 'index'])->name('level');
    Route::get('/admin/level/create', [SubjectLevelController::class, 'create'])->name('level.create');
    Route::post('/admin/level/create', [SubjectLevelController::class, 'store'])->name('level.save');
    Route::get('/admin/level/edit/{id}', [SubjectLevelController::class, 'edit'])->name('level.edit');
    Route::put('/admin/level/edit/{id}', [SubjectLevelController::class, 'update'])->name('level.update');
    Route::delete('/admin/level/{id}', [SubjectLevelController::class, 'destroy'])->name('level.delete');

    Route::get('/admin/question', [QuestionController::class, 'index'])->name('question');
    Route::get('/admin/question/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/admin/question/create', [QuestionController::class, 'store'])->name('question.save');
    Route::get('/admin/question/edit/{id}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/admin/question/edit/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/admin/question/{id}', [QuestionController::class, 'destroy'])->name('question.delete');
});

Route::group(['middleware' => ['web', 'auth', 'student']], function(){
    Route::get('/student/dash', [StudentController::class, 'dash'])->name('student.dash');
});


