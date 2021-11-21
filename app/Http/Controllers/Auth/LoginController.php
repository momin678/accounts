<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Exception;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    
    protected function redirectTo(){
        if(Auth()->user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
            return redirect()->route('admin.dashboard');
        }elseif(Auth()->user()->user_type == 'user'){
            return redirect()->route('user.dashboard');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request){
        $input = $request->all();
        // dd($input);
        $this->validate($request,[
            'email' => 'required|email',
            'password' =>'required'
        ]);
        if(auth()->attempt(array('email'=>$request['email'], 'password'=>$request['password'])) ){
            // dd(Auth()->user()->user_type);
            if(Auth()->user()->user_type == "admin" || Auth()->user()->user_type == "staff"){
                return redirect()->route('admin.dashboard');
            }elseif(Auth()->user()->user_type == "user"){
                return redirect()->route('user.dashboard');
            }
        }else{
            return redirect()->route('login')->with('error', 'Invalid Email or Password');
        }
        
    }
    // social login
    protected $providers = [
        'facebook','google','twitter'
    ];

    public function show()
    {
        return view('auth.login');
    }

    public function redirectToProvider(Request $request, $driver)
    {
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

  
    public function handleProviderCallback($driver)
    {
        try {
            if($driver == 'twitter'){
                $user = Socialite::driver('twitter')->user();
            }
            else{
               $user = Socialite::driver($driver)->user();
            }
            // $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {
        return redirect()->route('user.dashboard');
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('social.login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();

        // if user already found
        if( $user ) {
            // update the avatar and provider that might have changed
            $user->update([
                'avatar' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            // create a new user
            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'user_type'=> 'user',
                'email_verified_at' => date('Y-m-d H:m:s'),
                'avatar' => $providerUser->getAvatar(),
                'provider' => $driver,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                'password' => ''
            ]);
        }

        // login the user
        Auth::login($user, true);

        return $this->sendSuccessResponse();
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

    
}
