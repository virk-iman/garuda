<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Request;
use Auth;

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
    public function login()
{
// validate the info, create rules for the inputs
$rules = array(
    'username'    => 'required', // make sure the email is an actual email
    'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
);

// run the validation rules on the inputs from the form
$validator = Validator::make(Request::all(), $rules);

// if the validator fails, redirect back to the form
if ($validator->fails()) {
    return Redirect::to('login')
        ->withErrors($validator) // send back all errors to the login form
        ->withInput(Request::except('password')); // send back the input (not the password) so that we can repopulate the form
} else {

    // create our user data for the authentication
    $userdata = array(
        'name'     => Request::get('username'),
        'password'  => Request::get('password')
    );

    // attempt to do the login
    if (Auth::attempt($userdata)) {

        // validation successful!
        // redirect them to the secure section or whatever
        // return Redirect::to('secure');
        // for now we'll just echo success (even though echoing in a controller is bad)
        return Redirect::to('drones/create');

    } else {        

        // validation not successful, send back to form 
        return Redirect::to('login');

    }

}
}

public function logout(Request $request) {
    Auth::logout();
    return redirect('/login');
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
}
