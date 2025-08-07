<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $auth;
    protected $session;
    protected $__cache;
    protected $event;
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $maxAttempts = 4;
    protected $decayMinutes = 2;

     public function __construct(){

        $this->auth = auth();
        $this->session = session();

        $this->middleware('guest')->except('logout');

    }

     public function username(){
        return 'username';
    }

    public function SHOWLOGIN(){

         session(['link' => url()->previous()]);

        return view('login.userlogin');
    }


    public function LOGIN(Request $request)
    {

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {

            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $guards = ['web'];

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->attempt($this->credentials($request))) {
                $user = $this->auth->guard($guard)->user();
                if (!$user->is_activated) {
                    $this->auth->guard($guard)->logout();
                    $this->session->flush();
                    $this->session->flash('AUTH_UNACTIVATED', 'Your account is deactivated or inactive. Please contact IT.');
                    return redirect()->back();
                }
                $this->clearLoginAttempts($request);
                session(['auth_guard' => $guard]);

                return redirect()->intended(route('admin.main.index'));
            }
        }



        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }



    public function LOGOUT(Request $request)
    {
        $this->session->flush();
        $this->guard()->logout();

        $request->session()->invalidate();

        Toastr::success('Thank you','You have been logged out');
        return redirect('/');
    }
}
