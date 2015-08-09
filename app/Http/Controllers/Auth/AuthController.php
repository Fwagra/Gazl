<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
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

       $this->create($request->all());
       Session::flash('message', trans('auth.registration_effective')); 
        return redirect($this->redirectPath());
    }
    public function postGuestLogin(Request $request)
    {
        $rules = array(
            'public_id' => 'required|max:4|min:4',
        );

        $messages = array(
            'public_id.required' => trans('auth.public_id_required'),
            'public_id.max' => trans('auth.public_id_max'),
            'public_id.min' => trans('auth.public_id_max'),
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        $public_id = Input::get('public_id');
        echo $public_id;
    }
}
