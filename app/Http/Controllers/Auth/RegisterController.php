<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $this->validator($request->all())->validate();

        $file = $request->file('photo');
        $filename = uniqid().'.'.$file->extension();
        $file->move(public_path('/photos/clients'), $filename);

        User::register(
            $data['login'],
            $data['email'],
            $data['password'],
            $data['fullname'],
            $filename
        );

        return redirect()->route('login')->with('success', 'Вы были успешно зарегестрированы');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:16|confirmed',
            'fullname' => 'required|string|max:255',
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'confirm' => 'required',
        ], [
            'required' => 'Поле :attribute должно быть заполнено',
            'email' => 'Вы ввели некорректный email адрес',
            'string' => 'Поле :attribute должно содержать строку',
            'min' => 'Поле :attribute не может быть короче :min символов',
            'max' => 'Поле :attribute может иметь максимум :max символов',
            'confirmed' => 'Поле :attribute не совпадает с введеным паролем',
        ]);
    }
}
