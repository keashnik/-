<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    }
    public function showLogin(){
        return view('login');
    }

    public function register(Request $request){
        $path = $request->file('avatar')->store('avatars', 'public');

        User::create([
            'full_name' => $request->full_name,
            'login' => $request->login,
            'avatar' => $path,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
        return redirect()->route('show.login')->with('success', 'Вы успешно зарегистрировальсь');
    }

    public function login(Request $request){
        $user = user::where('login', $request->login)->first();
        if($user && Hash::check($request->password, $user->password)){
            Auth::login($user);
            if($user->role==='admin'){
                return redirect()->route('show.admin')->with('seccess', 'Добро пожаловать в кабинет администратора');
            }elseif($user->role==='manager'){
                return redirect()->route('show.manager')->with('seccess', 'Добро пожаловать в кабинет менеджера');
            }else{
                return redirect()->route('show.user')->with('seccess', 'Добро пожаловать в кабинет пользователя');
            }
        } return redirect()->back()->with('error', 'Неверный логин или пароль');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('show.login')->with('success', 'Вы вышли с аккаунта');

    }
}
