<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\inbox;
use App\Models\Income;
use App\Models\Project;
use App\Models\ProjectPaid;
use App\Models\Setting;
use App\Models\SmsLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinaicalRequest extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.FinaicalRequest.index', compact('projects'));
    }

    public function send(Request $request)
    {
        $data = $this->validate(request(), [
            'message' => 'required|string',
            'type' => 'required|in:1,2,3',
            'project_id' => 'required|exists:projects,id',

        ]);

        $project = Project::whereId($request->project_id)->first();
        $client = $project->client;
        $emp = Auth::user();



        if ($request->type == 2 || $request->type == 3) {
            $inbox = inbox::create([
                'title' => "طلب دفعة مقدمة",
                'comments' => $request->message,
                'date' => Carbon::now()->format("Y-m-d"),
                'time' => Carbon::now()->format("H:i:s"),
                'sender_id' => $emp->id,
                'sender_name' => $emp->name,
                'recipient_id' => $client->id,
                'recipient_name' => $client->name,
                'project_id' => $project->id,
                'project_name' => $project->name,
                'level_id' => 0,
                'level_type' => 0,
                'level_name' => "1",
                'empl' => 0,
                'sub' => 0,
                'view' => 0,
                'client_view' => 0,
                'is_Replay' => 0,
                'updated_at' => Carbon::now(),
                'mail_type' => 1,
            ]);
        }
        if ($request->type == 1 || $request->type == 3) {
            $ch = curl_init();
            $url = "http://basic.unifonic.com/rest/SMS/messages";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=pm@uramit.com&password=uram123&msg=".$message."&sender=Bus-exc.&to=".$client->phone."&encoding=UTF8"); // define what you want to post
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $request->message . "&SenderID=ALKHALIL&Recipient=" . $client->phone . "&encoding=UTF8&responseType=json"); // define what you want to post
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);

            $setting = Setting::find(1);
            $setting->sms_used = 2 + $setting->sms_used;
            $setting->save();
            $description = 'اشعار طلب دفعة مقدمة للعميل    ' . $client->phone;
            $dataLog = array('type' => 2, 'user_id' => $client->id, 'description' => $description, 'sms_count' => 2);
            SmsLogs::insert($dataLog);
        }

        $token = $client->token_id;
        $title = $project->name;
        $message = " اشعار طلب دفعة مقدمة للمشروع  ";


        $fields = array(
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
        return back()->with('message', 'تم الارسال بنجاح');

    }

    public function ProjectFinancial($id)
    {

        $project_paid = ProjectPaid::where('project_id', $id)->first();
        if ($project_paid) {

            $income = Income::where('project_id', $id)->sum('amount');
            $data['paid'] = $project_paid->paid;
            $data['paid_down'] = $project_paid->paid_down + $income;
            $data['paid_term'] = $data['paid'] - $data['paid_down'];
            return response($data);
        } else {
            $data['paid'] = 0;
            $data['paid_down'] = 0;
            $data['paid_term'] = 0;
        }
    }


}
