<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller {
    protected $redirectTo = '/login';
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'm_name' => ['required', 'max:50'],
            'l_name' => ['required', 'max:50'],
            'email' => ['required','email', 'unique:users', 'max:50'],
            'login' => ['required','unique:users', 'max:50'],
            'phone' => ['required','numeric'],
            'password_r' => ['required', 'min:6','confirmed'],
            'password_re' => ['required', 'min:6'],
        ],[
            'name.required' => 'Поле имя обязательно заполнить',
            'm_name.required' => 'Поле отчество обязательно заполнить',
            'l_name.required' => 'Поле фамилия обязательно заполнить',
            'email.required' => 'Поле эл. почта обязательно заполнить',
            'email.unique' => 'Таким эл. почтой уже зарегистрированы',
            'email.email' => 'Эл. почта должна быть действующим адресом электронной почты.',
            'login.required' => 'Поле логин обязательно заполнить',
            'phone.required' => 'Поле телефон организация обязательно заполнить',
            'phone.numeric' => 'Поле телефон обязательно заполнить только цифры',
            'password_r.required' => 'Поле пароль организация обязательно заполнить',
            'password_r.min' => 'Поле пароль должен содержить 6 смиволов',
            'password_r.confirmed' => 'Пожалуйста потвердите пароль',
        ]);

        
        
        
        $data = New User;
        $data->name = $request->name;
        $data->m_name = $request->m_name;
        $data->l_name = $request->l_name;
        $data->email = $request->email;
        $data->login = $request->login;
        $data->phone = $request->phone;
        $data->role_id = 2;
        $data->password = Hash::make($request->password_r);
        $data->save();
        $user = User::where('email',$data->email)->first();
        
        Auth::Login($user,true);
        
        return redirect()->route('admin');
//                ('success', 'Вы успешно зарегистрировались');
        
    }
    

}
