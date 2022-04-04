<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Setting;
use App\Models\SmsLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function registerEmployee(Request $request){
        $data = $this->validate(request(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phone' => 'required|unique:users|digits:12',
            'state' => 'required|exists:state,id',
            'address' => 'required|string',
            'is_active' => 'nullable|string',

        ]);

        $data['is_active'] = 0;
        $data['date'] = date("Y-m-d H:i:s");
        $data['password'] = sha1($request->password);
        $data['ref_code'] = rand(1111, 9999);
        $data['firebase_type'] = 0;
        $data['token_id'] = " ";
        $data['msg'] = " ";


        $user = User::create($data);

        return back()->with('message','success');
    }
    public function Login(Request $request)
    {

        if ($user = User::where('phone', $request->phone)->where('password', sha1($request->password))->where('is_active',1)->first()) {
            Auth::login($user);
            return redirect('/');
        } else {
            return back()->with('message', 'Failed');
        }
    }

    public function logout(Request $request)
    {

        if (Auth::check()) {
            Auth::logout();
            return redirect('/login');
        } else {
            return redirect('/login');
        }
    }

    public function forgetPassword(Request $request)
    {
        $data = $this->validate(request(), [
            'phone' => 'required|exists:users,phone',
        ]);

        $code = rand(1111, 9999);
        $user = User::where('phone', $request->phone)->first();
        $user->code = $code;
        $user->save();
        // send sms
        $message = "رمز استعاده كلمة المرور الخاصة بك هى :" . $code;
        $ch = curl_init();
        $url = "http://basic.unifonic.com/rest/SMS/messages";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=pm@uramit.com&password=uram123&msg=".$message."&sender=Bus-exc.&to=".$client->phone."&encoding=UTF8"); // define what you want to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $message . "&SenderID=ALKHALIL&Recipient=" . $user->phone . "&encoding=UTF8&responseType=json"); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

        $setting = Setting::find(1);
        $setting->sms_used = 2 + $setting->sms_used;
        $setting->save();
        $description = 'ارسال استعاده كلمة المرور للرقم    ' . $user->phone;
        $dataLog = array('type' => 2, 'user_id' => $user->id, 'description' => $description, 'sms_count' => 2);
        SmsLogs::insert($dataLog);

        return view('auth/check-phone', compact('user'));


    }

    public function checkCode(Request $request)
    {
        $data = $this->validate(request(), [
            'id' => 'required|exists:users,id',
            'first' => 'required|numeric',
            'second' => 'required|numeric',
            'third' => 'required|numeric',
            'forth' => 'required|numeric',
        ]);

        $code = $request->first . $request->second . $request->third . $request->forth;

        $user = User::whereId($request->id)->first();
        if ($user->code == $code) {
            $user->code = null;
            $user->save();
            return view('auth/update-password', compact('user'));

        } else {
            return redirect()->back()->with('error', 'الرمز غير صحيح برجاء التاكد من الرمز');
        }

        return view('auth/check-phone', compact('user'));


    }

    public function updatePassword(Request $request)
    {

        $rules = [
            'id' => 'required|exists:users,id',
            'password' => 'required|confirmed|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return redirect('login')->with('error',$validator->messages()->first());
        }


        $user = User::whereId($request->id)->first();
        $user->password = sha1($request->password);
        $user->save();

        return view('auth/login')->with('success', 'تم استعادة كلمة المرور بنجاح');


    }
}
