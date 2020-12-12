<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);


        if ($this->attemptLogin($request)) {
            $request->session()->regenerate();

            if (\Auth::user()->isAdmin()) {
                return redirect()->route('admin.proposal.index');
            }

            return redirect()->route('user.proposal.index');
        }

        return redirect()->back()->with('error', 'Неверный логин или пароль');
    }

    public function username()
    {
        return 'login';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->back();
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [
            'required' => 'Поле :attribute должно быть заполнено',
            'string' => 'Поле :attribute должно содержать строку',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }


    protected function guard()
    {
        return \Auth::guard();
    }
}
