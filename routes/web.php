<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BatchSyllabusController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectLevelController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurrentAffairController;
use App\Http\Controllers\CurrentAffairQuestionController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PreviousQuestionController;
use App\Http\Controllers\PSCUpdateController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\ScertQuestionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StudentBatchController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\UserController;

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

Route::get('/test', [HelperController::class, 'test'])->name('test');

Route::get('/message', function () {
    return view('message');
})->name('message');

Route::get('/onam-celeb-2023-video', function () {
    return view('onam-celeb-2023-video');
})->name('onam2023vid');

Route::get('/onam-celeb-2023-gallery', function () {
    return view('onam-celeb-2023-gallery');
})->name('onam2023gal');

Route::get('/register', [StudentController::class, 'register'])->name('register');
Route::post('/register', [StudentController::class, 'save'])->name('student.register');
Route::get('/signin', [StudentController::class, 'show'])->name('signin.show');
Route::post('/signin', [StudentController::class, 'signin'])->name('signin');
Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
Route::get('/forgot', [StudentController::class, 'forgot'])->name('forgot');
Route::post('/forgot', [StudentController::class, 'sendemail'])->name('send.email');
Route::get('/resetpassword/{email}', [StudentController::class, 'resetpassword'])->name('resetpassword');
Route::post('/updatepassword', [StudentController::class, 'updatepassword'])->name('updatepassword');

Route::group(['middleware' => ['web', 'auth', 'student']], function(){
    Route::get('/student/active-exams/{type}', [StudentController::class, 'activeexams'])->name('student.active.exams');
    Route::get('/student/exam/{id}/{type}', [StudentController::class, 'exam'])->name('student.exam');
    Route::post('/student/exam/{id}/{type}', [StudentController::class, 'saveexam'])->name('student.exam.save');   
    Route::get('/student/exam/result/{id}/{type}', [StudentController::class, 'examresult'])->name('student.exam.result');
    Route::get('/student/exam/performance/{id}/{type}', [StudentController::class, 'examperformance'])->name('student.exam.performance');    
    Route::get('/student/dash', [StudentController::class, 'getprofile'])->name('student.profile.get');
    Route::put('/student/dash', [StudentController::class, 'profileupdate'])->name('student.profile.update');
    Route::get('/student/performance', [StudentController::class, 'studentperformance'])->name('student.performance');    
    Route::get('/student/freeexam', [StudentController::class, 'freeexam'])->name('student.freeexam');    
    Route::post('/student/freeexam', [StudentController::class, 'createfreeexam'])->name('student.freeexam.create');    
    Route::get('/student/question/{id}', [StudentController::class, 'getoptions'])->name('student.question');
    
    Route::get('/student/leave', [StudentController::class, 'leave'])->name('student.leave');
    Route::post('/student/leave', [StudentController::class, 'leaveupdate'])->name('student.leave.update');
    Route::post('/student/photo', [StudentController::class, 'uploadphoto'])->name('student.photo.upload');

    Route::get('/student/class-schedule/{type}', [StudentController::class, 'classschedule'])->name('student.class.schedule');
    Route::get('/student/fee-payment', [StudentController::class, 'feepayment'])->name('student.fee.payment');
    Route::get('/student/feedback', [StudentController::class, 'feedback'])->name('student.feedback');
    Route::post('/student/feedback', [StudentController::class, 'savefeedback'])->name('student.feedback.save');

    Route::get('/student/downloads/{type}', [StudentController::class, 'downloads'])->name('student.downloads');
    Route::get('/student/updates', [StudentController::class, 'updates'])->name('student.updates');
    Route::get('/student/videos/{type}', [StudentController::class, 'videos'])->name('student.videos');
    Route::get('/student/notes', [StudentController::class, 'notes'])->name('student.notes');
    Route::get('/student/notes/view/{id}', [StudentController::class, 'viewnote'])->name('student.viewnote');
    Route::get('/student/caffair', [StudentController::class, 'caffair'])->name('student.caffair');
    Route::post('/student/caffair/fetch', [StudentController::class, 'caffairfetch'])->name('student.caffair.fetch');
    Route::get('/student/revision', [StudentController::class, 'revision'])->name('student.revision');
});

Route::group(['middleware' => ['web', 'auth', 'admin']], function(){
    
    Route::get('/slider', [SliderController::class, 'index'])->name('slider');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/slider/create', [SliderController::class, 'store'])->name('slider.save');
    Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('/slider/edit/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.delete');

    Route::get('/branch', [BranchController::class, 'index'])->name('branch');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/create', [BranchController::class, 'store'])->name('branch.save');
    Route::get('/branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/edit/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('/branch/delete/{id}', [BranchController::class, 'destroy'])->name('branch.delete');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.save');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/settings', [AdminController::class, 'show'])->name('settings.show');
    Route::put('/settings/{id}', [AdminController::class, 'update'])->name('settings.update');

    Route::get('/studentregchart', [AdminController::class, 'studentregchart'])->name('dash.studentregchart');
    Route::get('/studentfeechart', [AdminController::class, 'studentfeechart'])->name('dash.studentfeechart');
    Route::get('/studentcancelledchart', [AdminController::class, 'studentcancelledchart'])->name('dash.studentcancelledchart');

    Route::get('/student/online', [StudentController::class, 'onlinestudents'])->name('onlinestudents');
    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student/create', [StudentController::class, 'store'])->name('student.save');
    Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/edit/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');
    Route::get('/student/{id}/{type}', [StudentController::class, 'batchstudents'])->name('batchstudents');

    Route::get('/course', [CourseController::class, 'index'])->name('course');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course/create', [CourseController::class, 'store'])->name('course.save');
    Route::get('/course/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/course/edit/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/course/delete/{id}', [CourseController::class, 'destroy'])->name('course.delete');

    Route::get('/batch', [BatchController::class, 'index'])->name('batch');
    Route::get('/batch/create', [BatchController::class, 'create'])->name('batch.create');
    Route::post('/batch/create', [BatchController::class, 'store'])->name('batch.save');
    Route::get('/batch/edit/{id}', [BatchController::class, 'edit'])->name('batch.edit');
    Route::put('/batch/edit/{id}', [BatchController::class, 'update'])->name('batch.update');
    Route::delete('/batch/delete/{id}', [BatchController::class, 'destroy'])->name('batch.delete');

    Route::get('/syllabus-status', [BatchSyllabusController::class, 'show'])->name('syllabus.show');
    Route::post('/syllabus-status', [BatchSyllabusController::class, 'fetch'])->name('syllabus.fetch');
    Route::get('/syllabus-status/update', [BatchSyllabusController::class, 'update'])->name('syllabus.update');
    Route::get('/getDropDown', [AdminController::class, 'getDropDown'])->name('getDropDown');

    Route::get('/module-status', [TopicController::class, 'showmodule'])->name('module.status.show');
    Route::post('/module-status', [TopicController::class, 'fetchmodule'])->name('module.status.fetch');
    Route::post('/module-status/save', [TopicController::class, 'savemodule'])->name('module.status.save');
    Route::delete('/module-status/delete/{id}', [TopicController::class, 'deletemodule'])->name('module.complete.delete');

    Route::get('/syllabus', [SyllabusController::class, 'index'])->name('syllabus');
    Route::get('/syllabus/create', [SyllabusController::class, 'create'])->name('syllabus.create');
    Route::post('/syllabus/create', [SyllabusController::class, 'store'])->name('syllabus.save');
    Route::get('/syllabus/edit/{id}', [SyllabusController::class, 'edit'])->name('syllabus.edit');
    Route::put('/syllabus/edit/{id}', [SyllabusController::class, 'update'])->name('syllabus.update');
    Route::delete('/syllabus/delete/{id}', [SyllabusController::class, 'destroy'])->name('syllabus.delete');

    Route::get('/student-batch/create', [StudentBatchController::class, 'create'])->name('student.batch.create');
    Route::post('/student-batch/create', [StudentBatchController::class, 'store'])->name('student.batch.save');

    Route::get('/student-batch', [StudentBatchController::class, 'index'])->name('student.batch');
    Route::get('/student-batch/edit/{id}', [StudentBatchController::class, 'edit'])->name('student.batch.edit');
    Route::put('/student-batch/edit/{id}', [StudentBatchController::class, 'update'])->name('student.batch.update');
    Route::delete('/student-batch/delete/{id}', [StudentBatchController::class, 'destroy'])->name('student.batch.delete');

    Route::get('/fee', [FeeController::class, 'index'])->name('fee.show');
    Route::post('/fee', [FeeController::class, 'show'])->name('fee.fetch');
    Route::get('/fee/create/{id}', [FeeController::class, 'create'])->name('fee.create');
    Route::post('/fee/create', [FeeController::class, 'store'])->name('fee.save');
    Route::get('/fee/edit/{id}', [FeeController::class, 'edit'])->name('fee.edit');
    Route::put('/fee/edit/{id}', [FeeController::class, 'update'])->name('fee.update');
    Route::delete('/fee/delete/{id}', [FeeController::class, 'destroy'])->name('fee.delete');

    Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');
    Route::post('/attendance', [AttendanceController::class, 'createemptyattendance'])->name('attendance.sheet.create');
    Route::get('/updateAttendance', [AttendanceController::class, 'updateAttendance'])->name('updateAttendance');

    Route::get('/head', [HeadController::class, 'index'])->name('head');
    Route::get('/head/create', [HeadController::class, 'create'])->name('head.create');
    Route::post('/head/create', [HeadController::class, 'store'])->name('head.save');
    Route::get('/head/edit/{id}', [HeadController::class, 'edit'])->name('head.edit');
    Route::put('/head/edit/{id}', [HeadController::class, 'update'])->name('head.update');
    Route::delete('/head/delete/{id}', [HeadController::class, 'destroy'])->name('head.delete');

    Route::get('/income', [IncomeController::class, 'index'])->name('income');
    Route::get('/income/create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('/income/create', [IncomeController::class, 'store'])->name('income.save');
    Route::get('/income/edit/{id}', [IncomeController::class, 'edit'])->name('income.edit');
    Route::put('/income/edit/{id}', [IncomeController::class, 'update'])->name('income.update');
    Route::delete('/income/delete/{id}', [IncomeController::class, 'destroy'])->name('income.delete');

    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expense/create', [ExpenseController::class, 'store'])->name('expense.save');
    Route::get('/expense/edit/{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::put('/expense/edit/{id}', [ExpenseController::class, 'update'])->name('expense.update');
    Route::delete('/expense/delete/{id}', [ExpenseController::class, 'destroy'])->name('expense.delete');

    Route::get('/report/daybook', [ReportController::class, 'daybook'])->name('report.daybook');
    Route::post('/report/daybook', [ReportController::class, 'fetchdaybook'])->name('report.daybook.fetch');
    Route::get('/report/fee', [ReportController::class, 'fee'])->name('report.fee');
    Route::post('/report/fee', [ReportController::class, 'fetchfee'])->name('report.fee.fetch');
    Route::get('/report/fee-pending', [ReportController::class, 'feepending'])->name('report.feepending');
    Route::post('/report/fee-pending', [ReportController::class, 'fetchfeepending'])->name('report.feepending.fetch');
    Route::get('/report/attendance', [ReportController::class, 'attendance'])->name('report.attendance');
    Route::post('/report/attendance', [ReportController::class, 'fetchattendance'])->name('report.attendance.fetch');
    Route::get('/report/student', [ReportController::class, 'student'])->name('report.student');
    Route::post('/report/student', [ReportController::class, 'fetchstudent'])->name('report.student.fetch');
    Route::get('/report/attendance/summary', [ReportController::class, 'attendancesummary'])->name('report.attendance.summary');
    Route::post('/report/attendance/summary', [ReportController::class, 'fetchattendancesummary'])->name('report.attendance.summary.fetch');
    Route::get('/report/ie', [ReportController::class, 'ie'])->name('report.ie');
    Route::post('/report/ie', [ReportController::class, 'iefetch'])->name('report.ie.fetch');

    Route::get('/pdf/admission-fee/{id}', [PDFController::class, 'admissionfee'])->name('admissionfee');
    Route::get('/pdf/batch-fee/{id}', [PDFController::class, 'batchfee'])->name('batchfee');

    Route::get('/email/admission-fee/{id}', [PDFController::class, 'emailadmissionfee'])->name('emailadmissionfee');
    Route::get('/email/batch-fee/{id}', [PDFController::class, 'emailbatchfee'])->name('emailbatchfee');

    Route::get('/admin/subject', [SubjectController::class, 'index'])->name('subject');
    Route::get('/admin/subject/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/admin/subject/create', [SubjectController::class, 'store'])->name('subject.save');
    Route::get('/admin/subject/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
    Route::put('/admin/subject/edit/{id}', [SubjectController::class, 'update'])->name('subject.update');
    Route::delete('/admin/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.delete');

    Route::get('/admin/topic', [TopicController::class, 'index'])->name('topic');
    Route::post('/admin/topic', [TopicController::class, 'assign'])->name('course.module.save');
    Route::get('/admin/topic/create', [TopicController::class, 'create'])->name('topic.create');
    Route::post('/admin/topic/create', [TopicController::class, 'store'])->name('topic.save');
    Route::get('/admin/topic/edit/{id}', [TopicController::class, 'edit'])->name('topic.edit');
    Route::put('/admin/topic/edit/{id}', [TopicController::class, 'update'])->name('topic.update');
    Route::delete('/admin/topic/{id}', [TopicController::class, 'destroy'])->name('topic.delete');
    
    Route::get('/admin/revision', [RevisionController::class, 'index'])->name('revision');
    Route::get('/admin/revision/create', [RevisionController::class, 'create'])->name('revision.create');
    Route::post('/admin/revision/create', [RevisionController::class, 'store'])->name('revision.save');
    Route::get('/admin/revision/edit/{id}', [RevisionController::class, 'edit'])->name('revision.edit');
    Route::put('/admin/revision/edit/{id}', [RevisionController::class, 'update'])->name('revision.update');
    Route::delete('/admin/revision/{id}', [RevisionController::class, 'destroy'])->name('revision.delete');

    Route::get('/admin/level', [SubjectLevelController::class, 'index'])->name('level');
    Route::get('/admin/level/create', [SubjectLevelController::class, 'create'])->name('level.create');
    Route::post('/admin/level/create', [SubjectLevelController::class, 'store'])->name('level.save');
    Route::get('/admin/level/edit/{id}', [SubjectLevelController::class, 'edit'])->name('level.edit');
    Route::put('/admin/level/edit/{id}', [SubjectLevelController::class, 'update'])->name('level.update');
    Route::delete('/admin/level/{id}', [SubjectLevelController::class, 'destroy'])->name('level.delete');

    Route::get('/admin/scertquestion', [ScertQuestionController::class, 'index'])->name('scertquestion');
    Route::get('/admin/scertquestion/create', [ScertQuestionController::class, 'create'])->name('scertquestion.create');
    Route::post('/admin/scertquestion/create', [ScertQuestionController::class, 'store'])->name('scertquestion.save');
    Route::get('/admin/scertquestion/edit/{id}', [ScertQuestionController::class, 'edit'])->name('scertquestion.edit');
    Route::put('/admin/scertquestion/edit/{id}', [ScertQuestionController::class, 'update'])->name('scertquestion.update');
    Route::delete('/admin/scertquestion/{id}', [ScertQuestionController::class, 'destroy'])->name('scertquestion.delete');

    Route::get('/admin/question', [QuestionController::class, 'index'])->name('question');
    Route::get('/admin/question/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/admin/question/create', [QuestionController::class, 'store'])->name('question.save');
    Route::get('/admin/question/edit/{id}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/admin/question/edit/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/admin/question/{id}', [QuestionController::class, 'destroy'])->name('question.delete');

    Route::get('/admin/previousquestion', [PreviousQuestionController::class, 'index'])->name('previousquestion');
    Route::get('/admin/previousquestion/create', [PreviousQuestionController::class, 'create'])->name('previousquestion.create');
    Route::post('/admin/previousquestion/create', [PreviousQuestionController::class, 'store'])->name('previousquestion.save');
    Route::get('/admin/previousquestion/edit/{id}', [PreviousQuestionController::class, 'edit'])->name('previousquestion.edit');
    Route::put('/admin/previousquestion/edit/{id}', [PreviousQuestionController::class, 'update'])->name('previousquestion.update');
    Route::delete('/admin/previousquestion/{id}', [PreviousQuestionController::class, 'destroy'])->name('previousquestion.delete');

    Route::get('/admin/caffairquestion', [CurrentAffairQuestionController::class, 'index'])->name('caffairquestion');
    Route::get('/admin/caffairquestion/create', [CurrentAffairQuestionController::class, 'create'])->name('caffairquestion.create');
    Route::post('/admin/caffairquestion/create', [CurrentAffairQuestionController::class, 'store'])->name('caffairquestion.save');
    Route::get('/admin/caffairquestion/edit/{id}', [CurrentAffairQuestionController::class, 'edit'])->name('caffairquestion.edit');
    Route::put('/admin/caffairquestion/edit/{id}', [CurrentAffairQuestionController::class, 'update'])->name('caffairquestion.update');
    Route::delete('/admin/caffairquestion/{id}', [CurrentAffairQuestionController::class, 'destroy'])->name('caffairquestion.delete');

    Route::get('/admin/exam', [ExamController::class, 'index'])->name('exam');
    Route::get('/admin/exam', [ExamController::class, 'index'])->name('exam');
    Route::get('/admin/exam/create', [ExamController::class, 'create'])->name('exam.create');
    Route::post('/admin/exam/create', [ExamController::class, 'store'])->name('exam.save');
    Route::get('/admin/exam/assign/{id}', [ExamController::class, 'assign'])->name('exam.assign');
    Route::post('/admin/exam/assign', [ExamController::class, 'assignsave'])->name('exam.assign.save');
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

    Route::get('/admin/chapter', [ChapterController::class, 'index'])->name('chapter');
    Route::get('/admin/chapter/create', [ChapterController::class, 'create'])->name('chapter.create');
    Route::post('/admin/chapter/create', [ChapterController::class, 'store'])->name('chapter.save');
    Route::get('/admin/chapter/edit/{id}', [ChapterController::class, 'edit'])->name('chapter.edit');
    Route::put('/admin/chapter/edit/{id}', [ChapterController::class, 'update'])->name('chapter.update');
    Route::delete('/admin/chapter/{id}', [ChapterController::class, 'destroy'])->name('chapter.delete');

    Route::get('/faculty', [FacultyController::class, 'index'])->name('faculty');
    Route::get('/faculty/create', [FacultyController::class, 'create'])->name('faculty.create');
    Route::post('/faculty/create', [FacultyController::class, 'store'])->name('faculty.save');
    Route::get('/faculty/edit/{id}', [FacultyController::class, 'edit'])->name('faculty.edit');
    Route::put('/faculty/edit/{id}', [FacultyController::class, 'update'])->name('faculty.update');
    Route::delete('/faculty/delete/{id}', [FacultyController::class, 'destroy'])->name('faculty.delete');

    Route::get('/cschedule', [ClassScheduleController::class, 'index'])->name('cschedule');
    Route::get('/cschedule/create', [ClassScheduleController::class, 'create'])->name('cschedule.create');
    Route::post('/cschedule/create', [ClassScheduleController::class, 'store'])->name('cschedule.save');
    Route::get('/cschedule/edit/{id}', [ClassScheduleController::class, 'edit'])->name('cschedule.edit');
    Route::put('/cschedule/edit/{id}', [ClassScheduleController::class, 'update'])->name('cschedule.update');
    Route::delete('/cschedule/delete/{id}', [ClassScheduleController::class, 'destroy'])->name('cschedule.delete');

    Route::get('/admin/docs', [DownloadController::class, 'index'])->name('docs');
    Route::get('/admin/docs/create', [DownloadController::class, 'create'])->name('docs.create');
    Route::post('/admin/docs/create', [DownloadController::class, 'store'])->name('docs.save');
    Route::get('/admin/docs/edit/{id}', [DownloadController::class, 'edit'])->name('docs.edit');
    Route::put('/admin/docs/edit/{id}', [DownloadController::class, 'update'])->name('docs.update');
    Route::delete('/admin/docs/delete/{id}', [DownloadController::class, 'destroy'])->name('docs.delete');

    Route::get('/admin/psc', [PSCUpdateController::class, 'index'])->name('psc');
    Route::get('/admin/psc/create', [PSCUpdateController::class, 'create'])->name('psc.create');
    Route::post('/admin/psc/create', [PSCUpdateController::class, 'store'])->name('psc.save');
    Route::get('/admin/psc/edit/{id}', [PSCUpdateController::class, 'edit'])->name('psc.edit');
    Route::put('/admin/psc/edit/{id}', [PSCUpdateController::class, 'update'])->name('psc.update');
    Route::delete('/admin/psc/delete/{id}', [PSCUpdateController::class, 'destroy'])->name('psc.delete');

    Route::get('/admin/record', [RecordController::class, 'index'])->name('record');
    Route::get('/admin/record/create', [RecordController::class, 'create'])->name('record.create');
    Route::post('/admin/record/create', [RecordController::class, 'store'])->name('record.save');
    Route::get('/admin/record/edit/{id}', [RecordController::class, 'edit'])->name('record.edit');
    Route::put('/admin/record/edit/{id}', [RecordController::class, 'update'])->name('record.update');
    Route::delete('/admin/record/delete/{id}', [RecordController::class, 'destroy'])->name('record.delete');

    Route::get('/admin/caffair', [CurrentAffairController::class, 'index'])->name('caffair');
    Route::get('/admin/caffair/create', [CurrentAffairController::class, 'create'])->name('caffair.create');
    Route::post('/admin/caffair/create', [CurrentAffairController::class, 'store'])->name('caffair.save');
    Route::get('/admin/caffair/edit/{id}', [CurrentAffairController::class, 'edit'])->name('caffair.edit');
    Route::put('/admin/caffair/edit/{id}', [CurrentAffairController::class, 'update'])->name('caffair.update');
    Route::delete('/admin/caffair/delete/{id}', [CurrentAffairController::class, 'destroy'])->name('caffair.delete');

    Route::get('/admin/leaves', [AdminController::class, 'leaves'])->name('leaves');
    Route::get('/admin/dashdemo', [AdminController::class, 'dashdemo'])->name('dashdemo');

    Route::post('/admin/record/delete', [AdminController::class, 'deleteRecord'])->name('admin.record.delete');
});

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/dash', [AdminController::class, 'dash'])->name('dash');
    Route::get('/helper/module', [HelperController::class, 'module'])->name('helper.module');
    Route::get('/studentperfchart/{id}/{type}', [HelperController::class, 'studentperfchart'])->name('studentperfchart');
    Route::get('/studentperfchartall', [HelperController::class, 'studentperfchartall'])->name('studentperfchartall');
});





