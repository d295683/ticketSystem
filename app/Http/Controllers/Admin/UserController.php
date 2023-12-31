<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var array $rules A list of validation rules for the controller
     */
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        // 'roles' => 'required',
        'roles' => 'required|array|min:1',
    ];

    /**
     * @var array $messages A list of messages to display when validation fails
     */
    protected $messages = [
        'name.required' => 'Name is required',
        'email.required' => 'Email is required',
        'email.email' => 'Email is not valid',
        'roles.required' => 'Roles cannot be empty',
        'roles.array' => 'Roles must be an array',
        'roles.min' => 'Roles cannot be empty',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all users
        $users = User::paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = User::findOrfail($user->id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.users.edit', ['user' => $user->id])
                ->with('error', $validator->errors())
                ->withInput();
        }

        // update user
        $user = User::findOrFail($user->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // sync roles with user
        $user->roles()->sync($request->input('roles'));

        // save user
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);

        // delete user
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
