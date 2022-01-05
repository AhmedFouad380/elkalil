<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Explan;
use App\Models\inbox;
use App\Models\inboxFile;
use App\Models\Income;
use App\Models\Project;
use App\Models\ProjectContract;
use App\Models\ProjectPaid;
use App\Models\SmsLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ContractsController extends Controller
{
    public function index()
    {
        return view('admin.Contracts.index');
    }

    public function datatable(Request $request)
    {
        $data = Project::where('is_accepted',1)->where('confirm',0)->orderBy('id', 'asc')->get();
        return Datatables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->editColumn('name', function ($row) {
                $name = '';
                $name .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</span>
                                   <br> <small class="text-gray-600">' . $row->email . '</small>';
                return $name;
            })->editColumn('confirm', function ($row) {
    if ($row->confirm == 1) {
        return '<div class="badge badge-light-success fw-bolder"> مفعل</div>';
    } else {
        return '<div class="badge badge-light-info fw-bolder"> غير مفعل</div>';
    }
})
            ->editColumn('date', function ($row) {
                return \Carbon\Carbon::parse($row->date)->format('Y-m-d H:i');

            })
            ->addColumn('type', function ($row) {

                return Contract::find($row->projectContract->contract_id)->title;
            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("Contracts-edit/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> عرض </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'date', 'type','confirm'])
            ->make();

    }
    public function edit($id){

        $data = Project::findOrFail($id);
        $explans = Explan::OrderBy('id','desc')->where('project_id',$id)->get();
        return view('admin.Contracts.edit',compact('data','explans'));
    }

    public function UpdateProjectContract(Request $request){

        if(isset($request->price)){
            $data = ProjectContract::where('project_id',$request->id)->first();
            $data->price=$request->price;
            $data->save();
        }
        if(isset($request->template)){
            $data = ProjectContract::where('project_id',$request->id)->first();
            $data->template=$request->template;
            $data->save();
        }

        return back()->with('message','Success');
    }
    public function UpdateProjectPaid(Request $request){
        $data = ProjectPaid::where('project_id',$request->id)->first();

        if(isset($request->paid)){
            $data->paid=$request->paid;
        }
        if(isset($request->paid_down)){
            $data->paid_down=$request->paid_down;
        }
        if(isset($request->paid_term)){
            $data->paid_term=$request->paid_term;
        }
        $data->save();
        if(isset($request->values)){
            foreach($request->values as $val){
                $Income = new Income();
                $Income->amount=$val;
                $Income->project_id=$request->id;
                $Income->date=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');
                $Income->created_at=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');
                $Income->project_id=$request->id;
                $Income->type=1;
                $Income->project_name=Project::find($request->id)->name;
                $Income->save();
            }
        }
        return back()->with('message','Success');

    }
    public function ConfirmProject(Request $request){

        $Project = Project::find($request->project_id);
        $Project->confirm_date=$request->date;
        $Project->confirm=1;
        $Project->save();

        // add explan
        $d_explan = array(
            'title' => 'تم بدا تنفيذ المشروع',
            'comments' => 'تم بدا تنفيذ المشروع',
            'date' => $request->date,
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
            'project_id' => $request->project_id
        );
        Explan::insert($d_explan);

        // send sms

        $message = "
عزيزي العميل ، نرحب بكم في شركة الخليل ، ونفيدكم بانه تم تفعيل المشروع الخاص بكم .. بإمكانكم الان تحميل التطبيق الخاص بعملاء الخليل من المتجر والمتابعة ";


        $client = Client::find($Project->client_id);

        $ch = curl_init();
        $url = "http://basic.unifonic.com/rest/SMS/messages";
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=pm@uramit.com&password=uram123&msg=".$message."&sender=Bus-exc.&to=".$client->phone."&encoding=UTF8"); // define what you want to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=ngKAr3bTdAMthOzNZumtHX3DaEuJEx&Body=".$message."&SenderID=ALKHALIL-GR&Recipient=".$client->phone."&encoding=UTF8&responseType=json"); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec ($ch);
        curl_close ($ch);


        $setting = Setting::find(1);
        $setting->sms_used= 2 + $setting->sms_used;
        $setting->save();

        $description = 'ارسال رسالة تفعيل المشروع للرقم    '.$client->phone;

        $dataLog = array('type'=>2 , 'user_id'=> $client->id , 'description' => $description , 'sms_count' => 2);
        SmsLogs::insert($dataLog);

        // send inbox
        $msg='تم تفعيل مشروع '.$Project->name;

        $inbox = array(
            'title' => 'اشعار تفعيل المشروع ',
            'comments' => $msg,
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'sender_id' => Auth::user()->id,
            'sender_name' => Auth::user()->name,
            'recipient_id' => $client->id,
            'recipient_name' => $client->name,
            'project_id' => $Project->id,
            'project_name' => $Project->name,
            'updated_at' =>\Carbon\Carbon::now()

        );
        inbox::insert($inbox);

        // send Notification To Super Users
        $users = User::where('jop_type',3)->get();
        foreach($users as $user){

            if($user->token_id != null){

                // send fcm start
                $token = $user->token_id; // push token


                $title  = $Project->name;
                $message = " اشعار تفعيل  مشروع   ";
                $fields = array
                (
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

                // send Fcm end


            }

        }
        // end send Notification To Super Users

        // send Notification To  Users Same State
        $users = User::where('jop_type',2)->where('state',$Project->state)->get();
        foreach($users as $user){

            if($user->token_id != null){

                // send fcm start
                $token = $user->token_id; // push token


                $title  = $Project->name;
                $message = " اشعار تفعيل  مشروع   ";
                $fields = array
                (
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

                // send Fcm end


            }

        }
        // end send Notification To  Users Same State
        return response()->json(['message' => 'Success']);
    }


}
