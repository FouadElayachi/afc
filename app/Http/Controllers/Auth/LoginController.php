<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        if(Auth::user()->lang == 1){
        Auth::logout();
        return redirect('/fr');
        }
        else{
            Auth::logout();
            return redirect('/');
        }
    }


    public function authenticated(Request $request, $user)
    {
        if (!$user->is_active) {
            auth()->logout();
            if($user->verifyUser->is_used){
                return redirect('/login')->with('status', "Votre compte a été desactivé :(.");            
            }
            if($user->lang == 1)
            return back()->with('warning', 'Vous devez confirmer votre compte. Nous vous avons envoyé un code d\'activation, veuillez vérifier votre email (vous trouverez l\'e-mail dans le spam).');
            else return back()->with('warning', 'لقد توصلتم برسالة لتأكيد تسجيلكم. المرجوا تفقد بريدكم الإلكتروني (تجدون الرسالة في spam)');
        }
        if($user->type == 1) $this->redirectTo = '/administration';
        else if($user->type == 2) $this->redirectTo = '/administration2';
        else {
            if($user->lang == 0)
            $this->redirectTo = '/الرئيسية';
            else $this->redirectTo = '/home';
        }
        return redirect()->intended($this->redirectPath());
    }

}
