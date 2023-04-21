<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentExam;
use App\Models\StudentExamScore;
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
    public function index()
    {
        return view('register');
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:students,email',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'dob' => 'required',
            'qualification' => 'required',
            'password' => 'required|confirmed|min:6',
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
            if($user->role == 'Admin'):
                return redirect()->route('admin.dash')->with("success", "User logged in successfully!");
            else:
                return redirect()->route('student.dash')->with("success", "User logged in successfully!");
            endif;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activeexams(){
        $student = Student::where('email', Auth::user()->email)->first();
        $exams = Exam::whereIn('batch_id', $student->batches->pluck('batch'))->whereDate('exam_date', '>=', Carbon::today())->get();
        return view('student.active-exams', compact('exams', 'student'));
    }

    public function exam($id){
        $exam = Exam::find($id);
        return view('student.exam', compact('exam'));
    }

    public function saveexam(Request $request, $id){
        $exam = Exam::find($id);
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
            $input['wrong_answer_count'] = (!empty($op['0'])) ? $op['0'] : 0;
            $input['correct_answer_count'] = (!empty($op['1'])) ? $op['1'] : 0;
            $input['unattended_count'] = (!empty($op_unattended['1'])) ? $op['1'] : 0;
            $input['total_mark'] = $input['correct_answer_count'];
            $input['cutoff_mark'] = 0.33*($input['wrong_answer_count']-$input['unattended_count']);
            $input['total_mark_after_cutoff'] = $input['correct_answer_count'] - $input['cutoff_mark'];
            $input['student_id'] = $request->user()->student->id;
            $input['exam_id'] = $exam->id;
            $input['grade'] = 0;
            DB::transaction(function() use ($input, $exam) {
                $se = StudentExam::create($input);
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
                StudentExamScore::insert($data);
            });
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('student.active.exams')->with('success', "Congratulations! You have successfully completed your exam.");
    }

    public function examresult($id){
        $exam = StudentExam::find($id);
        if($exam):
            $student = Auth::user()->student;
            return view('student.result', compact('exam', 'student'));
        else:
            return redirect()->back()->with('error', "No records found.");
        endif;
    }
}
