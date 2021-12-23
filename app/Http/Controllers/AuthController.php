<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{
    public function Login(Request $request){

        if($user = User::where('phone',$request->phone)->where('password',sha1($request->password))->first()){
            Auth::login($user);
            return redirect('/');
        }else{
            return back()->with('message','Failed');
        }
    }

    public function logout(Request $request){

        if(Auth::check()){
            Auth::logout();
            return redirect('/login');
        }else{
            return redirect('/login');
        }
    }
}
