<?php

namespace BruceCms\Pages;

use App/Http/Controllers/Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App/User;

class AuthenticationController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    public function index()
    {
        $users = User::all();

        return view('auth.index', compact('users'))
    }

    /**
     *  Create a new Admin.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     *  Store the newly created admin.
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $this->create($request->all());

        return redirect('admins');
    }

    /**
     * Edit an existing Admin.
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('auth.edit', compact('user'));
    }

    /**
     *  Update an existing Admin
     */
    public function update($id, Request $request)
    {
        $user = User::find($id);

        $user->update($request->all());

        return redirect('admins');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect('admins');
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
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
