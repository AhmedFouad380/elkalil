<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectContract;
use App\Models\ProjectPaid;
use App\Models\Explan;
use App\Models\Setting;
use App\Models\SmsLogs;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    public function index()
    {
    }


    public function store_quest(Request $request)
    {

        $date_now =  date("Y-m-d H:i:s") ;
        $date     =  date("Y-m-d") ;
        $time     =  date("H:i:s") ;
        $phone = '966'.$request->phone;

        $check_phone = Client::where('phone',$phone)->first();
        $check_email = Client::where('email',$request->email)->first();

        if ($check_phone == null && $check_email == null) {

            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $phone;
            $data['password'] = '7c4a8d09ca3762af61e59520943dc26494f8941b';
            $data['date'] = $date_now;
            $data['state'] = $request->state;
            $data['is_active'] = 1;
            $data['users_group'] = 0;
            $data['branche'] = 1;
            $data['address'] = "";
            $data['ref_code'] = 0;
            $data['token_id'] = "";
            $data['msg'] = "";
            $client = Client::create($data);
            
        } else {
            if ($check_phone != null) {
                $client_id = $check_phone->id ;
            } else {
                $client_id = $check_email->id ;
            }

        }
        
        dd($client_id);

        $data = new Page;
        $data->title = $request->title;
        $data->content = $request->content;
        $data->title_en = $request->title_en;
        $data->content_en = $request->content_en;
        $data->meta_keywords = $request->meta_keywords;
        $data->meta_description = $request->meta_description;
        $data->save();

        // return redirect('admin/pages')->with('msg', 'Success');
    }

}
