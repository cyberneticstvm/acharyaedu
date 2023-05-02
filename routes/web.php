<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectLevelController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TopicController;

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
})->name('login');
Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/message', function () {
    return view('message');
})->name('message');

Route::get('/register', [StudentController::class, 'index'])->name('register');
Route::post('/register', [StudentController::class, 'store'])->name('student.save');
Route::get('/signin', [StudentController::class, 'show'])->name('signin.show');
Route::post('/signin', [StudentController::class, 'signin'])->name('signin');
Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
Route::get('/forgot', [StudentController::class, 'forgot'])->name('forgot');
Route::post('/forgot', [StudentController::class, 'sendemail'])->name('send.email');
Route::get('/resetpassword/{email}', [StudentController::class, 'resetpassword'])->name('resetpassword');
Route::post('/updatepassword', [StudentController::class, 'updatepassword'])->name('updatepassword');

Route::group(['middleware' => ['web', 'auth', 'admin']], function(){
    Route::get('/admin/dash', [AdminController::class, 'dash'])->name('admin.dash');

    Route::get('/admin/subject', [SubjectController::class, 'index'])->name('subject');
    Route::get('/admin/subject/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/admin/subject/create', [SubjectController::class, 'store'])->name('subject.save');
    Route::get('/admin/subject/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
    Route::put('/admin/subject/edit/{id}', [SubjectController::class, 'update'])->name('subject.update');
    Route::delete('/admin/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.delete');

    Route::get('/admin/topic', [TopicController::class, 'index'])->name('topic');
    Route::get('/admin/topic/create', [TopicController::class, 'create'])->name('topic.create');
    Route::post('/admin/topic/create', [TopicController::class, 'store'])->name('topic.save');
    Route::get('/admin/topic/edit/{id}', [TopicController::class, 'edit'])->name('topic.edit');
    Route::put('/admin/topic/edit/{id}', [TopicController::class, 'update'])->name('topic.update');
    Route::delete('/admin/topic/{id}', [TopicController::class, 'destroy'])->name('topic.delete');

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

    Route::get('/admin/exam', [ExamController::class, 'index'])->name('exam');
    Route::get('/admin/exam/create', [ExamController::class, 'create'])->name('exam.create');
    Route::post('/admin/exam/create', [ExamController::class, 'store'])->name('exam.save');
    Route::get('/admin/exam/edit/{id}', [ExamController::class, 'edit'])->name('exam.edit');
    Route::put('/admin/exam/edit/{id}', [ExamController::class, 'update'])->name('exam.update');
    Route::delete('/admin/exam/{id}', [ExamController::class, 'destroy'])->name('exam.delete');

    Route::get('/admin/eq', [ExamQuestionController::class, 'index'])->name('eq');
    Route::get('/admin/eq/create/{id}', [ExamQuestionController::class, 'show'])->name('eq.show');
    Route::post('/admin/eq/create/{id}', [ExamQuestionController::class, 'create'])->name('eq.create');
    Route::get('/admin/eq/question', [ExamQuestionController::class, 'store'])->name('eq.question');
    Route::post('/admin/eq/question', [ExamQuestionController::class, 'store'])->name('eq.save');
    Route::delete('/admin/eq/delete/{id}', [ExamQuestionController::class, 'destroy'])->name('eq.delete');

    Route::get('/admin/module/questions/{id}', [HelperController::class, 'modulequestions'])->name('modulequestions');
    Route::get('/admin/subject/modules/{id}', [HelperController::class, 'subjectmodules'])->name('subjectmodules');

    Route::get('/admin/student/performance', [HelperController::class, 'studentperformanceall'])->name('studentperformanceall');    
    Route::post('/admin/student/performance', [HelperController::class, 'studentperformanceallget'])->name('studentperformanceall.get');
    Route::get('/admin/student/performance/exam/{id}', [HelperController::class, 'studentperformanceexam'])->name('studentperformanceexam');
    Route::get('/admin/exam/result/{id}', [HelperController::class, 'examresult'])->name('admin.exam.result');
    Route::get('/admin/exam/performance/{id}', [HelperController::class, 'examperformance'])->name('admin.exam.performance');
    Route::get('/studentperfchart/{id}', [HelperController::class, 'studentperfchart'])->name('studentperfchart');
});

Route::group(['middleware' => ['web', 'auth', 'student']], function(){
    Route::get('/student/active-exams', [StudentController::class, 'activeexams'])->name('student.active.exams');
    Route::get('/student/exam/{id}', [StudentController::class, 'exam'])->name('student.exam');
    Route::post('/student/exam/{id}', [StudentController::class, 'saveexam'])->name('student.exam.save');   
    Route::get('/studentperfchartall', [HelperController::class, 'studentperfchartall'])->name('studentperfchartall');
    Route::get('/student/exam/result/{id}', [StudentController::class, 'examresult'])->name('student.exam.result');
    Route::get('/student/exam/performance/{id}', [StudentController::class, 'examperformance'])->name('student.exam.performance');    
    Route::get('/student/dash', [StudentController::class, 'dash'])->name('student.dash');
    Route::put('/student/dash', [StudentController::class, 'profileupdate'])->name('student.profile.update');
    Route::get('/student/performance', [StudentController::class, 'studentperformance'])->name('student.performance');    
    Route::get('/student/studymaterials', [StudentController::class, 'studymaterials'])->name('student.studymaterials');    
    Route::post('/student/studymaterials', [StudentController::class, 'getstudymaterials'])->name('student.studymaterials.fetch');    
    Route::get('/student/question/{id}', [StudentController::class, 'getoptions'])->name('student.question');    
});

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/helper/module/{sid}', [HelperController::class, 'module'])->name('helper.module');
});



