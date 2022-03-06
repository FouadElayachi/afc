<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Http\Request;
use App\VerifyUser;
use App\Mail\VerifyMail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'first_name_fr' => ['required', 'string', 'min:3', 'max:255'],
            'last_name_fr' => ['required', 'string', 'min:3', 'max:255'],
            'first_name_ar' => ['required', 'string', 'min:3', 'max:255'],
            'last_name_ar' => ['required', 'string', 'min:3', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(url()->previous() == "".url('/')."/register"){
        $user = User::create([
            'email' => $data['email'],
            'first_name_fr' => $data['first_name_fr'],
            'last_name_fr' => $data['last_name_fr'],
            'first_name_ar' => $data['first_name_ar'],
            'last_name_ar' => $data['last_name_ar'],
            'lang' => '1',
            'password' => Hash::make($data['password']),
        ]);
        }
        else{
            $user = User::create([
                'email' => $data['email'],
                'first_name_fr' => $data['first_name_fr'],
                'last_name_fr' => $data['last_name_fr'],
                'first_name_ar' => $data['first_name_ar'],
                'last_name_ar' => $data['last_name_ar'],
                'password' => Hash::make($data['password']),
            ]);
        }
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
        Mail::to($user->email)->send(new VerifyMail($user));
        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser)){
            $user = $verifyUser->user;
            if(!$verifyUser->is_used){
                $verifyUser->user->is_active = true;
                $verifyUser->user->save();
                $verifyUser->is_used = true;
                $verifyUser->save();
                $user->is_active = true;
                $user->save();
                if($verifyUser->user->lang == 1)
                $status = "Votre e-mail est verfié. vous pouvez se connecter.";
                else 
                $status = "تم تأكيد حسابكم. يمكنكم الدخول الآن";
            }
            elseif(! $user->is_active){
                if($verifyUser->user->lang == 1)
                $status = "Votre compte a été desactiver.";
                else 
                $status = "تم توقيف حسابكم";
            }
            else{
                if($verifyUser->user->lang == 1)
                $status = "Votre e-mail est verfié. vous pouvez se connecter.";
                else 
                $status = "تم تأكيد حسابكم. يمكنكم الدخول الآن";
            }
        }else{
            return redirect('/register')->with('warning', "Veuillez verifier votre adresse e-mail!");
        }
        if($verifyUser->user->lang == 1)
        return redirect('/login')->with('status', $status);
        else return redirect('/الدخول')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        if(url()->previous() == "".url('/')."/register"){
            return redirect('/login')->with('status', 'Vous avez reçu un e-mail de verification. veuillez confirmer votre adresse e-mail (vous trouverez l\'e-mail dans le spam).');
        }
        else 
        return redirect('/الدخول')->with('status', 'لقد توصلتم برسالة لتأكيد تسجيلكم. المرجوا تفقد بريدكم الإلكتروني (تجدون الرسالة في spam)');
    }

}
