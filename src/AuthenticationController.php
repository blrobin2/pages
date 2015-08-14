<?php

namespace BruceCms\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Flash;

class AuthenticationController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth', [ 'except' => [ 'getLogin', 'postLogin' ] ]);
    }

    /**
     * Manage admins
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return view('auth.index', compact('users'));
    }

    /**
     * Create a new Admin
     *
     * @return Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store the new Admin
     *
     * @param  Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $this->createUser($request->all());

        Flash::message('Admin successfully created!');

        return redirect('admins');
    }

    /**
     * Edit an existing Admin
     *
     * @param  $id
     * @return Response
     */
    public function edit($id)
    {
        if (\Auth::user()->id != $id) {
            return redirect('admins');
        }

        $user = User::find($id);

        return view('auth.edit', compact('user'));
    }

    /**
     * Update an existing Admin
     *
     * @param  $id
     * @param  Request $request
     * @return Redirect
     */
    public function update($id, Request $request)
    {
        $data = $request->all();

        $validator = $this->updateValidator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        if ($request->has('password')) {
            $passwordValidator = $this->passwordValidator($request->all());

            if ($passwordValidator->fails()) {
                $this->throwValidationException($request, $passwordValidator);
            }

            $data['password'] = bcrypt($request->get('password'));
        }


        $user = User::findOrFail($id);
        $user->update($data);

        Flash::message('Profile successfully updated!');

        return redirect('admins');
    }

    /**
     * Destroy an Admin with the given $id
     *
     * @param  $id
     * @return Redirect
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('admins');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function updateValidator(array $data)
    {
         return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255',
         ]);
    }

    protected function passwordValidator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function createUser(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
