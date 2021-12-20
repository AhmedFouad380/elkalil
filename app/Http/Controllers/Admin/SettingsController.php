<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function Settings()
    {
        $settings = Setting::findOrFail(1);

        return view('admin.setting.public_setting', compact('settings'));
    }

    public function editSettings(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'logo' => 'nullable|image',
            'phone1' => 'required',
            'phone2' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'email1' => 'required|email',
            'email2' => 'required|email',
            'website' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'snapchat' => 'required',
            'facebook' => 'required',
        ]);

        $settings = Setting::findOrFail(1);

        $settings->title = $request->title;
        $settings->description = $request->description;
        if ($request->logo) {
            $settings->logo = $request->logo;
        }
        $settings->phone1 = $request->phone1;
        $settings->phone2 = $request->phone2;
        $settings->address1 = $request->address1;
        $settings->address2 = $request->address2;
        $settings->email1 = $request->email1;
        $settings->email2 = $request->email2;
        $settings->website = $request->website;
        $settings->twitter = $request->twitter;
        $settings->instagram = $request->instagram;
        $settings->snapchat = $request->snapchat;
        $settings->facebook = $request->facebook;
        $settings->save();
        return redirect(url('public_setting'))->with('message', 'تم التعديل بنجاح');
    }
}
