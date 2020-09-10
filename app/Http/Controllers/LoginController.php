<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Organization;


class LoginController extends Controller {

    public function login(Request $request) {

        $admin = $request->only(['email', 'password']);

        if (Auth::attempt($admin)) {
            $id = Auth::user()->id;
			if(Auth::user()->role_id == 2){
				$result = Organization::where("user_id",$id)->where("org_active",1)->orderBy('id', 'desc')->first()->toArray();
           if(isset($result)){
              $request->session()->put('org_name', $result['org_name']);
              $request->session()->put('org_id', $result['id']); 
           }
			}
            
                       
            return redirect()->intended('/admin');
        } else {

            return redirect()->intended('/');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

    public function redirectToProvider($website) {
        return Socialite::driver($website)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($website) {
        $user = Socialite::driver($website)->stateless()->user();
        
        // $user->token;
        $check = User::where('email',$user->email)->first();
        
        if($check){
            Auth::Login($check,true);
            
        }else{
            $data = new User;
            $data->name = $user->name;
            $data->email = $user->email;
            $data->provider_id = $user->id;
            $data->provider = $website;
            $data->role_id = 2;
            $data->save();
            Auth::Login($data,true);
            
        }
        
        
        return redirect('/admin');
        
        
    }

}
