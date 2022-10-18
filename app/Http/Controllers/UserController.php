<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\User\NewUserValidation;
use App\Http\Requests\Admin\User\UserUpdateRoleValidation;
use App\Http\Requests\Admin\User\UserUpdateValidation;
use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login (){
        return view('users.login');
    }

    public function loginPost (LoginValidation $request){
        if (Auth::attempt($request->validated())){
            $request->session()->regenerate();
            return back()->with(['success' => 'true']);
        }
        return back() -> withErrors(['auth' => 'Логин или пароль не верный!']);
    }

    public function register (){
        return view('users.register');
    }

    public function registerPost (RegisterValidation $request){
        $requests = $request->validated();
        $requests['password'] = Hash::make($requests['password']);
        User::create($requests);
        return redirect()->route('login')->with(['register' => 'true']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.newRegister', compact('roles'));
    }

    public function store(NewUserValidation $request)
    {
        $requests = $request->validated();
        $requests['password'] = Hash::make($requests['password']);
        User::create($requests);
        return redirect()->route('admin.users.index')->with(['register' => 'true']);
    }

    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('admin.user.users', compact('users','roles'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with(['success' => true]);
    }

    public function edit(Request $request, User $user)
    {
        $roles = Role::all();
        $request->session()->flashInput($user->toArray());
        return view('admin.user.Update', compact('user' , 'roles'));
    }

    public function update(UserUpdateValidation $request, User $user)
    {
        $validate = $request->validated();
        $user->update($validate);
        return redirect()->route('admin.users.index')->with(['update' => true]);
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function editRole(UserUpdateRoleValidation $request, User $user)
    {
        $validate = $request->validated();
        $user->update($validate);
        return redirect()->route('admin.users.index')->with(['role' => true]);
    }
}
