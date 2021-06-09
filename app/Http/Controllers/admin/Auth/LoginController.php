<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASH;


    public function showLogin(Request $request){
        return view('backend.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' =>'required|email|max:50',
            'password' =>'required',
        ]);
        $email = $request->email;
        $password = $request->password;
        if(Auth::guard('admin')->attempt(['email' => $email, 'password' => $password],$request->remember)){
return redirect()->intended(route('admin.dashboard'))->with('login_success','Successfully logged in');

        }else{
            session()->flush('login_failed',' Invalid Email or Password');
            return back();
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
