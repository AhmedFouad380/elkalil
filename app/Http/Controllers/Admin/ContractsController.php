<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Explan;
use App\Models\inbox;
use App\Models\inboxFile;
use App\Models\Income;
use App\Models\Installments;
use App\Models\Level;
use App\Models\LevelDetails;
use App\Models\Project;
use App\Models\ProjectContract;
use App\Models\ProjectLevelDetails;
use App\Models\ProjectLevels;
use App\Models\ProjectPaid;
use App\Models\Setting;
use App\Models\SmsLogs;
use App\Models\User;
use App\Models\UserChatPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ContractsController extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->userGroup->is_contracting;
            if ($this->id == 0) {
                return redirect('/');
            }
            return $next($request);

        });

    }


    public function index()
    {
        return view('admin.Contracts.index');
    }

    public function datatable(Request $request)
    {
        if (Auth::user()->jop_type == 3) {
            $data1 = Project::where('is_accepted', 1)->where('view', 0)
                ->orderBy('date', 'desc')->get();
            $data2 = Project::where('is_accepted', 1)->where('view', 1)
                ->orderBy('accept_date', 'desc')->get();
            $data = $data1->merge($data2);
        } elseif (Auth::user()->jop_type == 2) {
            $data1 = Project::where('state', Auth::user()->state)->where('view', 0)
                ->where('is_accepted', 1)->orderBy('date', 'desc')->get();
            $data2 = Project::where('state', Auth::user()->state)->where('view', 1)
                ->where('is_accepted', 1)->orderBy('accept_date', 'desc')->get();
            $data = $data1->merge($data2);
        }
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
            ->rawColumns(['actions', 'checkbox', 'name', 'date', 'type', 'confirm'])
            ->setRowClass(function ($row) {
                return $row->view == 0 ? 'unread' : '';
            })
            ->make();

    }

    public function edit($id)
    {

        $data = Project::findOrFail($id);
        $data->view = 1;
        $data->save();
        $explans = Explan::OrderBy('id', 'desc')->where('project_id', $id)->get();
        return view('admin.Contracts.edit', compact('data', 'explans'));
    }

    public function UpdateClientData(Request $request)
    {
        $data = Project::find($request->id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->save();
        $client = Client::find($data->client_id);
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->save();

        $contract = ProjectContract::where('project_id', $request->id)->first();
        $contract->contract_id = $request->contract_id;
        $contract->save();

        return back()->with('message', 'Success');

    }

    public function UpdateProjectContract(Request $request)
    {

        if (isset($request->price)) {
            $data = ProjectContract::where('project_id', $request->id)->first();
            $data->price = $request->price;
            $data->save();

            $d_explan = array(
                'title' => 'تم تعديل عرض السعر',
                'comments' => 'تم تعديل عرض السعر',
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'emp_id' => Auth::user()->id,
                'emp_name' => Auth::user()->name,
                'project_id' => $request->id
            );
            Explan::insert($d_explan);

        }
        if (isset($request->template)) {
            $data = ProjectContract::where('project_id', $request->id)->first();
            $data->template = $request->template;
            $data->save();
            $d_explan = array(
                'title' => 'تم تعديل العقد',
                'comments' => 'تم تعديل العقد',
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'emp_id' => Auth::user()->id,
                'emp_name' => Auth::user()->name,
                'project_id' => $request->id
            );
            Explan::insert($d_explan);

        }

        return back()->with('message', 'Success');
    }

    public function UpdateProjectPaid(Request $request)
    {

        $data = ProjectPaid::where('project_id', $request->id)->first();
//        $total = $request->paid_down + $request->paid_down + array_sum($request->values);

//        if ($request->paid < $total) {
//            return back()->with('error_message', 'عفوا اجمالي الدفعات اكبر من مبلغ التعاقد ');
//        }
        if (isset($request->paid)) {
            $data->paid = $request->paid;
        }
        if (isset($request->paid_down)) {
            $data->paid_down = $request->paid_down;
        }
        if (isset($request->paid_term)) {
            $data->paid_term = $request->paid_term;
        }
        $data->save();
        if ($request->values) {
            if (isset($request->values) && array_sum($request->values) != 0) {
                $incomes = Installments::where('project_id', $request->id)->delete();
                foreach ($request->values as $key => $val) {
                    if ($request->values != 0) {
                        $Income = new Installments();
                        $Income->amount = $val;
                        $Income->project_id = $request->id;
                        $Income->installment_date = $request->dates[$key];
                        $Income->project_id = $request->id;

                        $Income->save();
                    }
                }
            }
        }
        // add explan
        $d_explan = array(
            'title' => 'تم تعديل المعلومات المالية ',
            'comments' => 'تم تعديل المعلومات المالية',
            'date' => \Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
            'project_id' => $request->id
        );
        Explan::insert($d_explan);
        return back()->with('message', 'Success');


    }

    public function ConfirmProject(Request $request)
    {

        $Project = Project::find($request->id);
        $Project->confirm_date = $request->date;
        $Project->confirm = 1;
        $Project->save();

        // add explan
        $d_explan = array(
            'title' => 'تم بدا تنفيذ المشروع',
            'comments' => 'تم بدا تنفيذ المشروع',
            'date' => $request->date,
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
            'project_id' => $request->id
        );
        Explan::insert($d_explan);

        // send sms

        $message = "
عزيزي العميل ، نرحب بكم في شركة الخليل ، ونفيدكم بانه تم تفعيل المشروع الخاص بكم .. بإمكانكم الان تحميل التطبيق الخاص بعملاء الخليل من المتجر والمتابعة ";


        $client = Client::find($Project->client_id);

        $ch = curl_init();
        $url = "http://basic.unifonic.com/rest/SMS/messages";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=pm@uramit.com&password=uram123&msg=".$message."&sender=Bus-exc.&to=".$client->phone."&encoding=UTF8"); // define what you want to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $message . "&SenderID=ALKHALIL-GR&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);


        $setting = Setting::find(1);
        $setting->sms_used = 2 + $setting->sms_used;
        $setting->save();

        $description = 'ارسال رسالة تفعيل المشروع للرقم    ' . $client->phone;

        $dataLog = array('type' => 2, 'user_id' => $client->id, 'description' => $description, 'sms_count' => 2);
        SmsLogs::insert($dataLog);

        // send inbox
        $msg = 'تم تفعيل مشروع ' . $Project->name;

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
            'updated_at' => \Carbon\Carbon::now()

        );
        inbox::insert($inbox);

        // send Notification To Super Users
        $users = User::where('jop_type', 3)->get();
        foreach ($users as $user) {

            if ($user->token_id != null) {

                // send fcm start
                $token = $user->token_id; // push token


                $title = $Project->name;
                $message = " اشعار تفعيل  مشروع   ";
                $fields = array
                (
                    'registration_ids' => [$token],
                    'data' => ['type' => '3'],
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
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                curl_close($ch);

                // send Fcm end


            }

        }
        // end send Notification To Super Users

        // send Notification To  Users Same State
        $users = User::where('jop_type', 2)->where('state', $Project->state)->get();
        foreach ($users as $user) {

            if ($user->token_id != null) {

                // send fcm start
                $token = $user->token_id; // push token


                $title = $Project->name;
                $message = " اشعار تفعيل  مشروع   ";
                $fields = array
                (
                    'registration_ids' => [$token],
                    'data' => ['type' => '3'],
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
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                curl_close($ch);

                // send Fcm end


            }

        }
        // end send Notification To  Users Same State
        $ProjectContract = ProjectContract::where('project_id', $Project->id)->first();
        $contract = Contract::find($ProjectContract->contract_id);

        // Create ProjectLevels
        $StanderLevels = Level::where('contract_id', $contract->id)->get();
        foreach ($StanderLevels as $level) {
            $ProjectLevels = new ProjectLevels();
            $ProjectLevels->title = $level->title;
            $ProjectLevels->percent = $level->percent;
            $ProjectLevels->contract_id = $level->contract_id;
            $ProjectLevels->project_id = $Project->id;
            $ProjectLevels->project_contract_id = $contract->id;
            $ProjectLevels->level_id = $level->id;
            $ProjectLevels->sort = $level->sort;
            $ProjectLevels->progress_time = $level->progress_time;
            $ProjectLevels->save();
            //Create LevelDetails
            $levelsDetails = LevelDetails::where('level_id', $level->id)->get();
            foreach ($levelsDetails as $de) {
                $ProjectLevelDetails = new ProjectLevelDetails();
                $ProjectLevelDetails->title = $de->title;
                $ProjectLevelDetails->project_id = $Project->id;
                $ProjectLevelDetails->level_id = $ProjectLevels->id;
//                        $ProjectLevelDetails->date=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');
                $ProjectLevelDetails->client_view = $de->client_view;
                $ProjectLevelDetails->sort = $de->sort;
                $ProjectLevelDetails->question_type = $de->question_type;
                $ProjectLevelDetails->values = $de->values;
                $ProjectLevelDetails->is_pdf = $de->is_pdf;
                $ProjectLevelDetails->emp_id = 0;
                $ProjectLevelDetails->save();
            }
            // chat permission
            $users = User::where('state', $request->state)->get();
            foreach ($users as $user) {
                $dataa = array('reciever_id' => $user->id, 'type' => 0, 'project_id' => $Project->id, 'level_id' => $ProjectLevels->id, 'is_read' => 1);
                UserChatPermission::insert($dataa);
            }
            $UserChatPermission = array('level_id' => $ProjectLevels->id, 'reciever_id' => $Project->client_id, 'type' => 1, 'project_id' => $Project->id);
            UserChatPermission::insert($UserChatPermission);

        }

        return response()->json(['message' => 'Success']);
    }

    public function Send_revision(Request $request)
    {


        $project_id = $request->project_id;
        $emp_id = $request->emp_id;
        $client_id = $request->client_id;
        $msg = $request->note;
        $type = $request->type;
        $Project = Project::find($project_id);
        $client = Client::find($client_id);

        if ($type == 1) {
            $ch = curl_init();
            $url = "http://basic.unifonic.com/rest/SMS/messages";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=pm@uramit.com&password=uram123&msg=".$message."&sender=Bus-exc.&to=".$client->phone."&encoding=UTF8"); // define what you want to post
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $msg . "&SenderID=ALKHALIL-GR&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);


            $setting = Setting::find(1);
            $setting->sms_used = 2 + $setting->sms_used;
            $setting->save();

            $description = 'ارسال رسالة اشعار مراجعه للعميل رقم    ' . $client->phone;

            $dataLog = array('type' => 2, 'user_id' => $client->id, 'description' => $description, 'sms_count' => 2);
            SmsLogs::insert($dataLog);
        }


        $inbox = array(
            'title' => ' تم ارسال اشعار مراجعه    ',
            'comments' => $msg,
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'sender_id' => Auth::user()->id,
            'sender_name' => Auth::user()->name,
            'recipient_id' => $client->id,
            'recipient_name' => $client->name,
            'project_id' => $Project->id,
            'project_name' => $Project->name,
            'updated_at' => \Carbon\Carbon::now()

        );
        inbox::insert($inbox);

        if ($client->token_id != null) {

            // send fcm start
            $token = $client->token_id; // push token


            $title = $Project->name;
            $message = "  اشعار مراجعه جديد ";
            $fields = array
            (
                'registration_ids' => [$token],
                'data' => ['type' => '3'],
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
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);

            // send Fcm end


        }

        $d_explan = array(
            'title' => 'تم ارسال  اشعار مراجعه',
            'comments' => 'تم ارسال  اشعار مراجعه',
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
            'project_id' => $request->project_id
        );
        Explan::insert($d_explan);
        // end send Notification To  Users Same State
        return back()->with('message', 'Success');
    }

    public function Send_paid(Request $request)
    {

        $paid = ProjectPaid::where('project_id', $request->project_id)->first();
        $Project = Project::find($request->project_id);
        $client = Client::find($Project->client_id);
        $msg = "عزيزي العميل ، نرحب بكم في شركة الخليل ، برجاء سداد الدفعة المقدمة من المشروع الخاص بكم بقيمة "
            . $paid->paid_down .
            " ريال " .

            "والمتابعة على (تطبيق عملاء الخليل) بعد السداد علما بأن قيمة العقد : "
            . $paid->paid . " ريال ";

        if ($request->type == 1) {


            $ch = curl_init();
            $url = "http://basic.unifonic.com/rest/SMS/messages";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=m.hegazy@uramit.com&password=Uramit@123123&msg=".$msg."&sender=ALKHALIL-GR&to=".$client->phone."&encoding=UTF8"); // define what you want to post
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $msg . "&SenderID=ALKHALIL-GR&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);


            $setting = Setting::find(1);
            $setting->sms_used = 2 + $setting->sms_used;
            $setting->save();

            $description = 'ارسال رسالة اشعار المعلومات المالية للعقد للعميل رقم    ' . $client->phone;

            $dataLog = array('type' => 2, 'user_id' => $client->id, 'description' => $description, 'sms_count' => 2);
            SmsLogs::insert($dataLog);


        } elseif ($request->type == 2) {

            $inbox = array(
                'title' => 'اشعار المعلومات المالية للعقد ',
                'comments' => $msg,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'sender_id' => Auth::user()->id,
                'sender_name' => Auth::user()->name,
                'recipient_id' => $client->id,
                'recipient_name' => $client->name,
                'project_id' => $Project->id,
                'project_name' => $Project->name,
                'updated_at' => \Carbon\Carbon::now()

            );
            inbox::insert($inbox);

        } elseif ($request->type == 3) {


            $ch = curl_init();
            $url = "http://basic.unifonic.com/rest/SMS/messages";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=m.hegazy@uramit.com&password=Uramit@123123&msg=".$msg."&sender=ALKHALIL-GR&to=".$client->phone."&encoding=UTF8"); // define what you want to post
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $msg . "&SenderID=ALKHALIL-GR&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);


            $setting = Setting::find(1);
            $setting->sms_used = 2 + $setting->sms_used;
            $setting->save();

            $description = 'ارسال رسالة اشعار المعلومات المالية للعقد للعميل رقم    ' . $client->phone;

            $dataLog = array('type' => 2, 'user_id' => $client->id, 'description' => $description, 'sms_count' => 2);
            SmsLogs::insert($dataLog);


            $inbox = array(
                'title' => 'اشعار المعلومات المالية للعقد ',
                'comments' => $msg,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'sender_id' => Auth::user()->id,
                'sender_name' => Auth::user()->name,
                'recipient_id' => $client->id,
                'recipient_name' => $client->name,
                'project_id' => $Project->id,
                'project_name' => $Project->name,
                'updated_at' => \Carbon\Carbon::now()

            );
            inbox::insert($inbox);
        }
        $d_explan = array(
            'title' => 'اشعار المعلومات المالية للعقد ',
            'comments' => 'تم ارسال اشعار  المعلومات المالية للعقد ',
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
            'project_id' => $request->project_id
        );
        Explan::insert($d_explan);

        return back()->with('message', 'Success');

    }

    public function Send_template(Request $request)
    {

        $Project = Project::find($request->project_id);
        $client = Client::find($Project->client_id);
        $Message = 'عزيزي العميل ، نرحب بكم في شركة الخليل ، , ونفيدكم بان العقد الخاص بكم جاهز على تطبيق عملاء الخليل ';


        if ($request->type == 1 || $request->type == 3) {


            $ch = curl_init();
            $url = "http://basic.unifonic.com/rest/SMS/messages";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $Message . "&SenderID=ALKHALIL-GR&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post
            //curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=fetoh@koof-ksa.com&password=fetoh000000&msg=".$Message."&sender=ALKHALIL-GR&to=".$user->phone."&encoding=UTF8"); // define what you want to post
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);


            $setting = Setting::find(1);
            $setting->sms_used = 1 + $setting->sms_used;
            $setting->save();

            $description = ' تم ارسال بيانات العقد للعميل' . $client->phone;

            $dataLog = array('type' => 2, 'user_id' => $client->id, 'description' => $description, 'sms_count' => 1);
            SmsLogs::insert($dataLog);


        } elseif ($request->type == 2 || $request->type == 3) {

            $inbox = array(
                'title' => ' ارسال بيانات العقد ',
                'comments' => $Message,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'sender_id' => Auth::user()->id,
                'sender_name' => Auth::user()->name,
                'recipient_id' => $client->id,
                'recipient_name' => $client->name,
                'project_id' => $Project->id,
                'project_name' => $Project->name,
                'updated_at' => \Carbon\Carbon::now()

            );
            inbox::insert($inbox);

        }
        $d_explan = array(
            'title' => 'تم ارسال بيانات العقد ',
            'comments' => 'تم ارسال بيانات العقد ',
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
            'project_id' => $request->project_id
        );
        Explan::insert($d_explan);

        return back()->with('message', 'Success');

    }


    public function Send_price(Request $request)
    {

        $Project = Project::find($request->project_id);
        $client = Client::find($Project->client_id);
        $Message = 'عزيزي العميل ، نرحب بكم في شركة الخليل ، , ونفيدكم بان عرض السعر الخاص بكم جاهز على تطبيق عملاء الخليل ';


        if ($request->type == 1 || $request->type == 3) {


            $ch = curl_init();
            $url = "http://basic.unifonic.com/rest/SMS/messages";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $Message . "&SenderID=ALKHALIL-GR&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post
            //curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=fetoh@koof-ksa.com&password=fetoh000000&msg=".$Message."&sender=ALKHALIL-GR&to=".$user->phone."&encoding=UTF8"); // define what you want to post
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);


            $setting = Setting::find(1);
            $setting->sms_used = 1 + $setting->sms_used;
            $setting->save();

            $description = ' تم ارسال بيانات عرض السعر للعميل رقم ' . $client->phone;

            $dataLog = array('type' => 2, 'user_id' => $client->id, 'description' => $description, 'sms_count' => 1);
            SmsLogs::insert($dataLog);


        } elseif ($request->type == 2 || $request->type == 3) {

            $inbox = array(
                'title' => '  بيانات عرض السعر ',
                'comments' => $Message,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'sender_id' => Auth::user()->id,
                'sender_name' => Auth::user()->name,
                'recipient_id' => $client->id,
                'recipient_name' => $client->name,
                'project_id' => $Project->id,
                'project_name' => $Project->name,
                'updated_at' => \Carbon\Carbon::now()

            );
            inbox::insert($inbox);

        }
        $d_explan = array(
            'title' => 'تم ارسال بيانات عرض السعر ',
            'comments' => 'تم ارسال بيانات عرض السعر ',
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
            'project_id' => $request->project_id
        );
        Explan::insert($d_explan);

        return back()->with('message', 'Success');

    }

    public function Send_quest(Request $request)
    {

        $Project = Project::find($request->project_id);
        $client = Client::find($Project->client_id);
        $link = 'http://alkhalilsys.com/admins/page/quest2/' . $Project->id;
        $Message = 'عزيزي العميل ، نرجو استكمال بيانات استبيان المشروع عن طريق الرابط التالي  : ' . $link;


        if ($request->type == 1 || $request->type == 3) {


            $ch = curl_init();
            $url = "http://basic.unifonic.com/rest/SMS/messages";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $Message . "&SenderID=ALKHALIL-GR&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post
            //curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=fetoh@koof-ksa.com&password=fetoh000000&msg=".$Message."&sender=ALKHALIL-GR&to=".$user->phone."&encoding=UTF8"); // define what you want to post
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);


            $setting = Setting::find(1);
            $setting->sms_used = 2 + $setting->sms_used;
            $setting->save();

            $description = 'ارسال رسالة استكمال بيانات استبيان المشروع للعميل رقم    ' . $client->phone;

            $dataLog = array('type' => 2, 'user_id' => $client->id, 'description' => $description, 'sms_count' => 2);
            SmsLogs::insert($dataLog);


        } elseif ($request->type == 2 || $request->type == 3) {

            $inbox = array(
                'title' => 'اشعار ارسال  استبيان المشروع للعميل',
                'comments' => $Message,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'sender_id' => Auth::user()->id,
                'sender_name' => Auth::user()->name,
                'recipient_id' => $client->id,
                'recipient_name' => $client->name,
                'project_id' => $Project->id,
                'project_name' => $Project->name,
                'updated_at' => \Carbon\Carbon::now()

            );
            inbox::insert($inbox);

        }
        $d_explan = array(
            'title' => 'تم ارسال  استبيان المشروع للعميل',
            'comments' => 'اشعار ارسال  استبيان المشروع للعميل',
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
            'project_id' => $request->project_id
        );
        Explan::insert($d_explan);


        // send fcm start
        if ($client->token_id) {

            $token = $client->token_id; // push token


            $title = $Project->name;
            $message = " اشعار استكمال استبيان المشروع  ";

            $fields = array
            (
                'registration_ids' => [$token],
                'data' => ['type' => '3'],
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
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
        }
        // send Fcm end
        return back()->with('message', 'Success');

    }


}
