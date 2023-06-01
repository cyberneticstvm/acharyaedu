<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Exam;
use App\Models\FreeExam;
use App\Models\FreeExamQuestion;
use App\Models\FreeExamScore;
use App\Models\FreeStudentExam;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentExam;
use App\Models\StudentExamScore;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use DB;
use Hash;
use Session;
use Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $courses = Course::all();
        return view('register', compact('courses'));
    }
    public function index()
    {
        $students = Student::where('branch', Auth::user()->branch)->where('course_id', 0)->orderByDesc('id')->get();
        $batches = Batch::where('status', 1)->get();
        $status = DB::table('status')->where('category', 'student')->get();        
        return view('admin.student.index', compact('students', 'batches', 'status'));
    }

    public function onlinestudents(){
        $students = Student::where('branch', Auth::user()->branch)->where('course_id', '>', 0)->orderByDesc('id')->get();
        $batches = Batch::where('status', 1)->get();
        $status = DB::table('status')->where('category', 'student')->get();        
        return view('admin.student.students', compact('students', 'batches', 'status'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('admin.student.create', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dash()
    {
        return view('student.dash');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:students,email',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'dob' => 'required',
            'qualification' => 'required',
            'password' => 'required|confirmed|min:6',
            'course_id' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = 0;        
        $input['updated_by'] = 0;
        $input['branch'] = 1;
        $input['role'] = 'Student';
        $input['status'] = 'Active';  
        $input['password'] = Hash::make($request->password);
        try{
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::transaction(function() use ($input) {                
                Student::create($input);                
                User::create($input);
            });
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }        
        return redirect()->route('register')->with('success', 'Student Registered Successfully!');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:students,email',
            'mobile' => 'required|numeric|digits:10',
            'admission_date' => 'required',
            'address' => 'required',
            'fee' => 'required',
            'branch' => 'required',
        ]);
        $input = $request->all();
        if($request->hasFile('photo')):
            $img = $request->file('photo');
            $fname = 'photos/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['photo'] = $img->getClientOriginalName();                                 
        endif;
        $input['created_by'] = Auth::user()->id;        
        $input['updated_by'] = Auth::user()->id;
        $input['status'] = 'Active';
        $input['branch'] = 1;
        $input['role'] = 'Student';
        $input['password'] = Hash::make($request->mobile);
        DB::transaction(function() use ($input) {
            Student::create($input);
            User::create($input);
        });        
        return redirect()->route('student')->with('success', 'Student Created Successfully!');
    }

    public function getprofile(){
        return view('student.dash');
    }

    public function profileupdate(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:students,email,'.$request->user()->student->id,
            'mobile' => 'required|numeric|digits:10',
        ]);
        $input = $request->all();
        $user = User::find($request->user()->id); $student = Student::find($request->user()->student->id);
        $input['password'] = ($request->password) ? Hash::make($request->password) : $user->getOriginal('password');
        DB::transaction(function() use ($input, $user, $student) {                
            $student->update($input);                
            $user->update($input);
        });
        return redirect()->route('student.dash')->with("success", "Profile updated successfully!");
    }

    public function signin(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password', 'status');
        if(Auth::attempt($credentials)):
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($user, $request->get('remember'));
            return redirect()->route('dash');
        endif;  
        return redirect()->back()->with('error', 'Login details are not valid')->withInput($request->all());
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/')->with('success','User logged out successfully');
    }

    public function forgot(){
        return view('forgot');
    }

    public function sendemail(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
        ]);
        $user = User::where('email', $request->email)->first();
        if($user):
            Mail::send('password-reset', ['user' => $user], function($message) use($request){
                $message->to($request->email);
                $message->subject('Acharya - Password Reset Link');
            });        
            return redirect()->route('forgot')->with('success','Password chnage link has been sent to your registered email successfully. Please check your inbox/spam folder and click the password change link.');
        else:
            return redirect()->route('forgot')->with('error','Provided email id could not found in the records. Please try with another email id.')->withInput($request->all());
        endif;
    }

    public function resetpassword($email){
        $user = User::where('email', $email)->first();
        if($user):
            return view('change-password', compact('user'));
        else:
            return view('error');
        endif;
    }

    public function updatepassword(Request $request){
        $this->validate($request, [
            'password' => 'required|confirmed',
            'email' => 'required',
        ]);
        $password = Hash::make($request->password);
        try{
            User::where('email', $request->email)->where('id', $request->user_id)->update(['password' => $password]);
        }catch(Exception $e){
            throw $e;
        }
        return redirect()->back()
                        ->with('success', "You've successfully updated your password. Please Login to continue.");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('signin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $branches = Branch::all();
        return view('admin.student.edit', compact('student', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:students,email,'.$id,
            'mobile' => 'required|numeric|digits:10',
            'admission_date' => 'required',
            'address' => 'required',
            'fee' => 'required',
            'branch' => 'required',
        ]);
        $input = $request->all();
        $student = Student::find($id); $user = User::where('email', $student->email)->first();
        if($request->hasFile('photo')):
            $img = $request->file('photo');
            $fname = 'photos/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['photo'] = $img->getClientOriginalName();                                 
        endif;
        $input['updated_by'] = Auth::user()->id;
        DB::transaction(function() use ($input, $student, $user) {
            $student->update($input);
            $user->update($input);
        });
        return redirect()->route('student')->with('success', 'Student Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::find($id)->delete();
        return redirect()->route('student')->with('success', 'Student Deleted Successfully!');
    }

    public function activeexams(){
        $student = Student::where('email', Auth::user()->email)->first();
        $exams = Exam::whereIn('batch_id', $student->batches->pluck('batch'))->where('status', 1)->get(); //whereDate('exam_date', '>=', Carbon::today())->
        return view('student.active-exams', compact('exams', 'student'));
    }

    public function exam($id, $type){
        if($type == 'free'):
            $exam = FreeExam::find($id);
        else:
            $exam = Exam::find($id);
        endif;
        if(!isStudentAttended(Auth::user()->student->id, $id) && Auth::user()):
            return view('student.exam', compact('exam', 'type'));
        else:
            return redirect()->back()->with('error', "Exam already attended!");
        endif;
    }

    public function saveexam(Request $request, $id, $type){
        if($type == 'free'):
            $exam = FreeExam::find($id);
        else:
            $exam = Exam::find($id);
        endif;
        $input = $request->all();
        try{
            $arr = [];
            foreach($exam->questions as $key => $quest):
                $question = Question::find($quest->question_id);
                $answer = (isset($input['rad_'.$quest->id])) ? $input['rad_'.$quest->id] : NULL;
                $arr [] = [
                    'answer' => ($question->correct_option == $answer) ? 1 : 0,
                    'unattended' => ($answer == NULL) ? 1 : 0,
                ];
            endforeach;
            $op = array_count_values(array_column($arr, 'answer'));
            $op_unattended = array_count_values(array_column($arr, 'unattended'));
            //$wrong_unattended = (!empty($op['0'])) ? $op['0'] : 0;
            $input['correct_answer_count'] = (!empty($op['1'])) ? $op['1'] : 0;
            $input['unattended_count'] = (!empty($op_unattended['1'])) ? $op_unattended['1'] : 0;
            $input['wrong_answer_count'] = $exam->question_count-($input['correct_answer_count']+$input['unattended_count']);
            $input['total_mark'] = $input['correct_answer_count'];
            $input['cutoff_mark'] = cutoffMark($input['wrong_answer_count']);
            $input['total_mark_after_cutoff'] = $input['correct_answer_count'] - $input['cutoff_mark'];
            $input['student_id'] = $request->user()->student->id;
            $input['exam_id'] = $exam->id;
            $input['grade'] = 0;
            DB::transaction(function() use ($input, $exam, $type) {
                $se = ($type == 'free') ? FreeStudentExam::create($input) : StudentExam::create($input);
                $data = [];
                foreach($exam->questions as $key => $quest):
                    $question = Question::find($quest->question_id);
                    $answer = (isset($input['rad_'.$quest->id])) ? $input['rad_'.$quest->id] : NULL;
                    $data [] = [
                        'student_exam_id' => $se->id,
                        'question_id' => $question->id,
                        'subject_id' => $question->subject_id,
                        'correct_option' => $question->correct_option,
                        'selected_option' => $answer,
                        'answer' => ($question->correct_option == $answer) ? 1 : 0,     
                        'created_at' => Carbon::now(),               
                        'updated_at' => Carbon::now(),               
                    ];
                endforeach;
                if($type == 'free'):
                    FreeExamScore::insert($data);
                else:
                    StudentExamScore::insert($data);
                endif;
            });
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        if($type == 'free'):
            return redirect()->route('student.freeexam')->with('success', "Congratulations! You have successfully completed your exam.");
        else:
            return redirect()->route('student.active.exams')->with('success', "Congratulations! You have successfully completed your exam.");
        endif;
    }

    public function examresult($id, $type){
        if($type == 'free'):
            $exam = FreeStudentExam::find(decrypt($id));
        else:
            $exam = StudentExam::find(decrypt($id));
        endif;
        if($exam):
            $student = Student::find($exam->student_id);
            return view('student.result', compact('exam', 'student'));
        else:
            return redirect()->back()->with('error', "No records found.");
        endif;
    }

    public function examperformance($id, $type){
        if($id > 0):
            if($type == 'free'):
                $e = FreeStudentExam::find(decrypt($id));
                $exam = FreeExamScore::where('student_exam_id', decrypt($id))->first();
            else:
                $e = StudentExam::find(decrypt($id));
                $exam = StudentExamScore::where('student_exam_id', decrypt($id))->first();
            endif;
            $student = Student::find($e->student_id);
            return view('student.performance', compact('exam', 'student', 'type'));
        else:
            return redirect()->back()->with('error', "No result found");
        endif;
    }   

    public function freeexam(){
        //$subjects = Subject::inRandomOrder()->limit(1)->get(); 
        $modules = Topic::inRandomOrder()->limit(5)->get();
        $inputs = []; $exams = FreeExam::where('created_by', Auth::user()->student->id)->orderByDesc('id')->get();
        return view('student.free-exams', compact('modules', 'inputs', 'exams'));
    }

    public function createfreeexam(Request $request){
        $this->validate($request, [
            'subject_id' => 'required',
            'exam_date' => 'required',
        ]);
        $input = $request->all();
        $input['name'] = 'Exam #'. FreeExam::max('id')+1;
        $input['batch_id'] = 0;
        $input['cut_off_mark'] = 10;
        $input['question_count'] = 30;
        $input['duration'] = 30;
        $input['status'] = 0;
        $input['created_by'] = $request->user()->student->id;               
        $input['updated_by'] = $request->user()->student->id;
        $inputs = array($request->subject_id, $request->exam_date);
        $modules = Topic::where('subject_id', $request->subject_id)->get();
        $questions = Question::where('subject_id', $request->subject_id)->where('status', 1)->where('available_for_free', 1)->inRandomOrder()->limit(30)->get();
        if($questions->isEmpty()):
            return redirect()->back()->with('error', 'No records found')->withInput($request->all());
        else:
            try{
                DB::transaction(function() use ($input, $request, $questions){
                    $exam = FreeExam::create($input);
                    foreach($questions as $key => $question):
                        $data [] = [
                            'exam_id' => $exam->id,
                            'question_id' => $question->id,
                            'created_by' => $request->user()->student->id,
                            'updated_by' => $request->user()->student->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    endforeach;
                    FreeExamQuestion::insert($data);                    
                });
                $exams = FreeExam::where('created_by', $request->user()->student->id)->orderByDesc('id')->get();
                return view('student.free-exams', compact('modules', 'inputs', 'exams'));
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
            }            
        endif;        
    }

    public function getoptions($id){
        $question = Question::find($id);
        return view('student.question-options', compact('question'));
    }

    public function studentperformance(){
        return view('student.student-performance');
    }

    public function leave(){
        $student = Student::find(Auth::user()->student->id);
        $batches = Batch::whereIn('id', $student->batches->pluck('batch'))->pluck('name', 'id')->all();
        return view('student.leave', compact('student', 'batches'));
    }

    public function leaveupdate(Request $request){
        $this->validate($request, [
            'batch' => 'required',
            'reason' => 'required',
        ]);
        $attendance = Attendance::where('student', $request->user()->student->id)->where('batch', $request->batch)->whereDate('date', Carbon::today())->first();
        if(empty($attendance)):
            return redirect()->back()->with('error', 'Attendance sheet yet to be generated.')->withInput($request->all());
        else:
            Attendance::where('id', $attendance->id)->update(['leave' => 1, 'present' => 0, 'absent' => 0, 'reason' => $request->reason]);
        endif;
        return redirect()->back()->with('success', 'Leave updated successfully');
    }

    public function uploadphoto(Request $request){
        $this->validate($request, [
            'photo' => 'required|file|max:250|mimes:jpg,png,jpeg',
        ]);
        $input = $request->all();
        $sid = $request->user()->student->id;
        if($request->hasFile('photo')):
            $img = $request->file('photo');
            $fname = 'student-photos/'.$sid.'/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            Student::where('id', $sid)->update(['photo' => $img->getClientOriginalName()]);                                 
        endif;
        return redirect()->back()->with('success', 'Photo updated successfully');
    }
}
