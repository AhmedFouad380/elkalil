<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Explan;
use App\Models\inbox;
use App\Models\Project;
use App\Models\ProjectLevels;
use App\Models\User;
use App\Models\UserChatPermission;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function AddGeneralSupervisor(Request $request){

        $this->validate(request(), [
            'project_id' => 'required',
            'emp_id' => 'required',
        ]);

        $Project = Project::find($request->project_id);
        $client = User::find($request->emp_id);
        $levels = ProjectLevels::where('project_id',$request->project_id)->get();
        foreach($levels as $level){
            if(UserPermission::where('emp_id',$request->emp_id)->where('level_id',$level->id)->count() == 0){
                $data = new UserPermission();
                $data->level_id=$level->id;
                $data->project_id=$request->project_id;
                $data->emp_id=$request->emp_id;
                $data->user_type=1;
                $data->save();

                $chat = new UserChatPermission();
                $chat->reciever_id=$request->emp_id;
                $chat->type=0;
                $chat->user_type=1;
                $chat->level_id=$level->id;
                $chat->project_id=$request->project_id;
                $chat->save();
            }
        }
        $user = User::find($request->emp_id);

        $inbox = array(
            'title' => " تم تكليفك بالاعمال في المشروع   ",
            'comments' => 'تم تكليفك بالاعمال في مشروع' . $Project->name,
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'sender_id' => $request->emp_id,
            'sender_name' => $user->name,
            'recipient_id' => $client->id,
            'recipient_name' => $client->name,
            'project_id' => $Project->id,
            'project_name' => $Project->name,
            'updated_at' =>\Carbon\Carbon::now(),
            'empl' =>2

        );
        inbox::insert($inbox);

        $d_explan = array(
            'title' => 'تم تعيين موظف للمشروع ',
            'comments' => 'تم تعيين موظف للمشروع ',
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_id' => $request->emp_id,
            'emp_name' => $user->name,
            'project_id' => $request->project_id
        );
        Explan::insert($d_explan);


        // send fcm start
        if($client->token_id) {

            $token = $client->token_id; // push token


            $title = $Project->name;
            $message = " تم تكليفك بالاعمال في المشروع   ";

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
        if($request->platform == 'web'){
            return back()->with('message','Success');
        }else{
            $object = array('status'=>200 , 'msg'=>'success ','ar_msg'=>'تم بنجاح','data'=>$data);
            return response()->json($object);
        }


    }

}
