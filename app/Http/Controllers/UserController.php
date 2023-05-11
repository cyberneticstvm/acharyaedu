<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;
use Hash;
use DB;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function acharya(){
        if(Auth::user())
            return redirect()->route('dash')->with("success", "Logged in successfully!");
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password', 'status');
        if(Auth::attempt($credentials)):
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($user, $request->get('remember'));
            return redirect()->route('dash')->with("success", "Logged in successfully!");
        endif;  
        return redirect("/")->with('error', 'Login details are not valid')->withInput($request->all());
    }

    /*public function dash(){
        if(Auth::user()->role == 'Admin'):
            $afee = Student::whereMonth('created_at', Carbon::now()->month)->sum('fee');
            $bfee = Fee::whereMonth('paid_date', Carbon::now()->month)->sum('fee');
            $income = Income::whereMonth('date', Carbon::now()->month)->sum('amount');
            $expense = Expense::whereMonth('date', Carbon::now()->month)->sum('amount');
            $income = $afee + $bfee + $income; $profit = $income - $expense;
            return view('admin.admin-dash', compact('income', 'expense', 'profit'));
        else:
            return view('admin.staff-dash');
        endif;
    }*/

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/')->with('success','User logged out successfully');
    }

    public function index()
    {
        $users = User::where('role', '!=', 'Student')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $status = DB::table('status')->where('category', 'user')->get();
        $roles = DB::table('user_roles')->get();
        return view('admin.user.create', compact('branches', 'status', 'roles'));
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
            'email' => 'required|email:filter|unique:users,email',
            'mobile' => 'required|numeric|digits:10',
            'password' => 'required',
            'role' => 'required',
            'status' => 'required',
            'branch' => 'required',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return redirect()->route('user')->with('success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $branches = Branch::all();
        $status = DB::table('status')->where('category', 'user')->get();
        $roles = DB::table('user_roles')->get();
        return view('admin.user.edit', compact('user', 'branches', 'status', 'roles'));
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
            'email' => 'required|email:filter|unique:users,email,'.$id,
            'mobile' => 'required|numeric|digits:10',
            'role' => 'required',
            'status' => 'required',
            'branch' => 'required',
        ]);
        $input = $request->all();
        $user = User::find($id);
        $input['password'] = ($request->password) ? Hash::make($request->password) : $user->getOriginal('password');      
        $user->update($input);
        return redirect()->route('user')->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user')->with('success', 'User Deleted Successfully!');
    }
}
