<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Project;
use Auth;
use Cookie;
use Illuminate\Http\Response;
use Session;
use Illuminate\Http\Request;
use Validator;
use \Input;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = 'auth/register';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     * - Overridden from Illuminate\Foundation\Auth trait
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        // Activate the first user automatically, all other users will need to 
        // be validated first (we set the status manually because we don't want 
        // it to be mass assignable).
        if ($user->id === 1) {
            $user->status = 1;
            $user->save();
        }

        Session::flash('message', trans('auth.registration_effective')); 

        return redirect($this->redirectPath());
    }

    public function postGuestLogin(Request $request)
    {
        $rules = array(
            'public_id' => 'required|max:4|min:4|exists:projects,public_id',
        );

        $messages = array(
            'public_id.required' => trans('auth.public_id_required'),
            'public_id.max' => trans('auth.public_id_max'),
            'public_id.min' => trans('auth.public_id_max'),
            'public_id.exists' => trans('auth.not_a_project'),
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }
        $publicId = Input::get('public_id');
        Cookie::queue('public_id', $publicId, 10000);
        $project = Project::publicId($publicId)->first();
        return redirect('project/'.$project->slug);
    }

    public function getGuestLogout()
    {
        return redirect('/')->withCookie(Cookie::forget('public_id'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        if(Cookie::get('public_id') != null){
            $cookie = Cookie::forget('public_id');
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        // Redirect to login form if the user is disabled.
        $user = User::where($this->loginUsername(), $request->input($this->loginUsername()))->first();
        if ($user AND !$user->status) {
            return redirect()->back()
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => trans('auth.failed'),
                ]);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (isset($cookie))
                return $this->handleUserWasAuthenticated($request, $throttles)->withCookie($cookie);
            else 
                return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
}
