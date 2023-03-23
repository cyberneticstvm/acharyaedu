<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Exception;
use DB;
use Hash;
use Session;

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
        $input['branch'] = 0;
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
}
