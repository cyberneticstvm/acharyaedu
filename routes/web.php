<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;

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
});

Route::group(['middleware' => ['web', 'auth', 'student']], function(){
    Route::get('/student/dash', [StudentController::class, 'dash'])->name('student.dash');
});


