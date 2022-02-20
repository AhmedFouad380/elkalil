<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectOther;
use App\Models\ProjectContract;
use App\Models\ProjectPaid;
use App\Models\Explan;
use App\Models\Setting;
use App\Models\SmsLogs;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

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

            $client_data['name'] = $request->name;
            $client_data['email'] = $request->email;
            $client_data['phone'] = $phone;
            $client_data['password'] = '7c4a8d09ca3762af61e59520943dc26494f8941b';
            $client_data['date'] = $date_now;
            $client_data['state'] = $request->state;
            $client_data['is_active'] = 1;

            $client_data['users_group'] = 0;
            $client_data['branche'] = 1;
            $client_data['address'] = "";
            $client_data['ref_code'] = 0;
            $client_data['token_id'] = "";
            $client_data['msg'] = "";
            $client = Client::create($client_data);

            $client_id = $client->id ;
        } else {
            if ($check_phone != null) {
                $client_id = $check_phone->id ;
            } else {
                $client_id = $check_email->id ;
            }

        }

        $project_data['name'] = $request->projectName;
        $project_data['phone'] = $phone;
        $project_data['email'] = $request->email;
        $project_data['services'] = $request->services;
        $project_data['country'] = $request->country;
        $project_data['state'] = $request->state;
        $project_data['know_us'] = $request->know_us;
        $project_data['project_type'] = $request->project_type;
        $project_data['area'] = $request->area;
        $project_data['duration'] = $request->duration;
        $project_data['plan'] = $request->plan;
        $project_data['is_customer'] = 1;
        $project_data['is_accepted'] = 2;
        $project_data['client_id'] = $client_id;
        $project_data['date'] = $date_now;

        $project_data['lat'] = "";
        $project_data['lng'] = "";
        $project_data['is_contract'] = 0;

        $project = Project::create($project_data);

        $project_other_data['project_id'] = $project->id;
        $project_other = ProjectOther::create($project_other_data);

        $contract_date = Contract::where('title','default')->first();
        $contract_default['project_id'] = $project->id;
        $contract_default['price'] = $contract_date->price;
        $contract_default['template'] = $contract_date->template;
        $contract_default['title'] = $contract_date->title;
        $contract_default['contract_id'] = $contract_date->id;

        $contract = ProjectContract::create($contract_default);

        $project_paid_data['project_id'] = $project->id;
        $project_paid = ProjectPaid::create($project_paid_data);

        $explan_data['project_id'] = $project->id;
        $explan_data['title'] = 'تم التقديم عن طريق التطبيق';
        $explan_data['comments'] = 'تم التقديم عن طريق التطبيق';
        $explan_data['date'] = $date;
        $explan_data['time'] = $time;

        $explan = Explan::create($explan_data);

        $message = "عملينا العزيز ، تم تسجيل البيانات الخاصة بكم وسيتم التواصل معكم خلال 48 ساعة ، شاكرين انتظاركم" ;

        $ch = curl_init();
        $url = "http://basic.unifonic.com/rest/SMS/messages";
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $request->message . "&SenderID=ALKHALIL&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec ($ch);
        curl_close ($ch);

        if($output == true){
            $setting = Setting::find(1);

            $setting_data = Setting::where('id', 1)->update([
                'sms_used' => 2 + $setting->sms_used
            ]);

            $description = 'ارسال رسالة تسجيل مشروع جديد للعميل رقم '.$phone;

            $sms_data['type'] = 2;
            $sms_data['user_id'] = $client_id;
            $sms_data['description'] = $description;
            $sms_data['sms_count'] = 2;

            $sms = SmsLogs::create($sms_data);
        }

        $users = DB::table('users')
        ->join('users_group', function ($join) {
            $join->on('users.users_group', '=', 'users_group.id')
                 ->where('users_group.is_client_order', 1);
        })
        ->get();

        foreach($users as $user){
            if($user->token_id != null){
                $token = $user->token_id; // push token
                $title  = "طلبات العملاء الجدد  ";
                $message = "هناك طلب جدبد  ";

                $fields = array (
                    'registration_ids'  => [$token],
                    'data'          => ['type'=>'3'],
                    'notification' => array(
                        'priority' => 'high',
                        'body' => $message,
                        'title' => $title,
                        'sound' => 'default',
                        'icon' => 'icon'
                        )
                );

                $API_ACCESS_KEY = 'AAAA7MITCVM:APA91bFxG1YuBa-5G6nYPwrn4KFrbKjtilNv-dlm5yXKOLJiGtMgdLSTCjYIY1i3M6Nf4au0r6b2mEL_MjfkGb1-haRJa-zZr1laU5uffby_y2n63IMaVgrh5u63aQRJZMnpJg-SAO5V';
                $headers = array
                (
                    'Authorization: key=' . $API_ACCESS_KEY,
                    'Content-Type: application/json'
                );
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
                curl_close( $ch );

            }
        }

        return redirect('/success_msg')->with('msg', 'Success');
    }

    public function quest2($client_id,$emp_id = null)
    {
        $query['project'] = Project::find($client_id);
        $query['p_other'] = ProjectOther::where('project_id', $client_id)->get()->first();
        return view('auth.request2', $query);
    }

    public function store_quest2(Request $request)
    {

        // dd($request->all());
        return redirect('/success_msg')->with('msg', 'Success');
    }

    public function success_msg () {
        return view('front.success_msg');
    }

    public function Get_Levels(Request $request){

        $contract = Contract::find($request->id);

        return view('admin.dashboardModel',compact('contract'));
    }
    public function getMoney(Request $request){

            $data = $request;
        return view('admin.dashboardTotalContract',compact('data'));
    }

    public function contractName(Request $request){

        $contract = Contract::find($request->id);

return $contract->title;
    }


}
