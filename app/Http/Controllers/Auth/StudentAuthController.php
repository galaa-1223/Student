<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequestStudent;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Student;

use Auth;

class StudentAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/student/login';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function studentGet()
    {
        return redirect(url('student/login'));
    }

    public function studentGetLogin()
    {
        return view('student.login.main', [
            'layout' => 'login'
        ]);
    }

    public function StudentLogin(LoginRequestStudent $request)
    {
        
        if (Auth::guard('student')->attempt([
                'email' => $request->email, 
                'password' => $request->password
            ]))
        {
            $user = Auth::guard('student')->user();
            
        } else {
            throw new \Exception('Wrong email or password.');
        }
    }

    public function studentLogout()
    {
        Auth::guard('student')->logout();   
        return redirect(url('student/login'));
    }
}