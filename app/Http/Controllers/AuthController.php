<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Login(Request $request){

        if($user = User::where('phone',$request->phone)->where('password',sha1($request->password))->first()){
            Auth::login($user);
            return redirect('/AdminPanel');
        }else{
            return back()->with('message','Failed');
        }
    }
}
