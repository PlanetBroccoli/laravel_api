<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
//use Socialite;
use Exception;
//use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
//        $user = Socialite::driver('facebook')->user();
        try {
//            $user = Socialite::driver($provider)->user();
            $name = $request->name;
//            $input['email'] = $request->email;
//            $input['provider'] = 'facebook';
//            $input['provider_id'] = 1;
//            $provider_token = $request->token;
//
//            $authUser = $this->findOrCreate($input);
//            Auth::loginUsingId($authUser->id);
//
//            return redirect()->route('home');
            return json_encode($name);


        } catch (Exception $e) {

            return json_encode('error');

//            return redirect('auth/'.$provider);

        }

        // $user->token;

        // return status, userID
    }

//    public function findOrCreate($input){
//        checkIfExist = User::where('provider',$input['provider'])
//            ->where('provider_id',$input['provider_id'])
//            ->first();
//
//        if($checkIfExist){
//            return $checkIfExist;
//        }
//
//        return User::create($input);
//    }
}
