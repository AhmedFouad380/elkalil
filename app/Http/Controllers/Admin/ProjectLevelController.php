<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Message;
use App\Models\Project;
use App\Models\ProjectContract;
use App\Models\ProjectLevelDetails;
use App\Models\ProjectLevels;
use App\Models\User;
use App\Models\UserChatPermission;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use Pusher\Pusher;
use Validator;
class ProjectLevelController extends Controller
{
    public function store_level(Request $request)
    {

        $lvl = ProjectLevels::where('project_id', $request->project_id)->OrderBy('id', 'desc')->first();
        $projectContract = ProjectContract::where('project_id', $request->project_id)->first();
        $totalPercent = ProjectLevels::where('project_id', $request->project_id)->sum('percent');
        $total = $totalPercent + $request->percent;
        if ($total > 100) {
            return back()->with('error_message', 'عفوا نسبة المرحلة اكبر من المسموح به ');
        }
        $data = new ProjectLevels();
        $data->title = $request->name;
        $data->percent = $request->percent;
        $data->project_contract_id = $projectContract->id;
        $data->project_id = $request->project_id;
        $data->created_by = Auth::user()->id;
        $data->emp_id = Auth::user()->id;
        $data->sort = $lvl->sort + 1;
        $data->save();

        return back()->with('message', 'Success');

    }

    public function CompleteLevel(Request $request)
    {
        $data = ProjectLevels::find($request->id);
        $data->auto_complete = 1;
        $data->progress= + $data->percent;
        $data->save();


        $project = Project::find($data->project_id);
        $project->progress=$project->progress + $data->percent;
        $project->save();

        return response()->json(['message' => 'Success']);

    }

    public function changeState(Request $request)
    {
        $data = ProjectLevelDetails::find($request->id);
        $data->state = 0;
        $data->date = null;
        $data->pdf=null;
        $data->img=null;
        $data->save();


        $projectLevel = ProjectLevels::find($data->level_id);
        $projectLevel->progress=$projectLevel->progress - $data->percent;
        $projectLevel->save();

        $project = Project::find($projectLevel->project_id);
        $project->progress=$project->progress - $data->percent;
        $project->save();

        return response()->json(['message' => 'Success']);

    }

    public function edit_LevelDetails(Request $request)
    {

        $data = ProjectLevelDetails::find($request->id);
        $data['fdp'] = Auth::user()->id . '@' . \Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d') . '@';
        return view('admin.Project.levelDetailsModel', compact('data'));

    }

    public function uploadPhoto(Request $request)
    {
        $imageName = "";
        $imageName = upload_multiple5($request->pdf, 'images');

        return '<input type="hidden" name="pdf[]" value="'.$imageName.'" />';
    }

    public function AnswerLevelDetails(Request $request)
    {

        $data = ProjectLevelDetails::find($request->id);
        if ($data->question_type == 1 || $data->question_type == 2) {

            $data->answer = $request->answer;

        } elseif ($data->question_type == 3) {

            $data->asnwer = implode('|', $request->answer);

        } elseif ($data->question_type == 4) {

//            $imageName = time().'.'.$request->img->extension();
//            $path = "https://alkhalilsys.com/images/";
////            $request->image->store('http://alkhalilsys.com/images/', $imageName);
//            Storage::disk('public2')->put('images', $imageName);
            $imageName = upload_multiple($request->img, 'images');
            $data->img = $imageName;

        } elseif ($data->question_type == 5) {

            $data->answer = $request->answer;
            $data->otherAnswer = $request->otherAnswer;

        }

        if (isset($request->pdf)) {
            $files = [];
            foreach ($request->pdf as $file) {
                //$imageName2 = upload_multiple($file, 'images');
                ////$data->img = $imageName2;
                // $imageName = upload_multiple2($file, 'images');
                $files[] = Auth::user()->id . '@' . \Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d') . '@'. $file;
            }
            $data->pdf = $files;

        }
        $data->state = 1;
        $data->date = \Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');

        $data->save();

        $projectLevel = ProjectLevels::find($data->level_id);
        $projectLevel->progress=$projectLevel->progress + $data->percent;
        $projectLevel->save();

        $project = Project::find($projectLevel->project_id);
        $project->progress=$project->progress + $data->percent;
        $project->save();
        return back()->with('message', 'Success');

    }

    public function store_new_levelDetail(Request $request)
    {

        $LastDetails = ProjectLevelDetails::where('level_id', $request->level_id)->OrderBy('id', 'desc')->first();
        $level = ProjectLevels::find($request->level_id);
        $totalPercent = ProjectLevelDetails::where('level_id', $request->level_id)->sum('percent');
        $total = $totalPercent + $request->percent;
        if ($total > $level->percent) {
            return back()->with('error_message', 'عفوا نسبة المرحلة اكبر من المسموح به ');
        }
        $data = new ProjectLevelDetails();
        $data->title = $request->name;
        $data->type = 1;
        $data->percent = $request->percent;
        if ($request->is_pdf == 1) {
            $data->is_pdf = $request->is_pdf;
        } else {
            $data->is_pdf = 0;

        }
        $data->level_id = $request->level_id;
        $data->project_id = $request->project_id;
        $data->UserAdded = 1;
        $data->emp_id = Auth::user()->id;
        $data->sort = $LastDetails->sort + 1;
        $data->save();

        return back()->with('message', 'Success');

    }

    public function Store_ProgressTime(Request $request)
    {

        $data = ProjectLevels::find($request->level_id);
        $data->progress_time = $request->progress_time;
        $data->save();

        $sum = ProjectLevels::where('project_id',$data->project_id)->sum('progress_time');
        $Project = Project::find($data->project_id);
        $Project->delivery_date = \Carbon\Carbon::parse($Project->confirm_date)->addDays($sum)->format('Y-m-d');;
        $Project->save();

        return back()->with('message', 'Success');

    }

    public function GetLevelDetails($id)
    {
        $data = ProjectLevelDetails::where('level_id', $id)->pluck('id', 'title');
        return response()->json($data);
    }

    public function ChatLevel($id){

        $level = ProjectLevels::findOrFail($id);
        $data = Project::find($level->project_id);
        $chat = Message::where('level_id',$id)->get();

        UserChatPermission::where('reciever_id',Auth::user()->id)->where('type',0)->where('level_id',$id)->update([
            'is_read'=>1
        ]);
        return view('admin.Project.chat',compact('level','data','chat'));
    }

    public function StoreChat(Request $request){

        $this->validate(request(), [
            'message' => 'required|string',
            'level_id' => 'required|exists:project_levels,id',
        ]);

        if(Auth::check()){
            $user_id=Auth::user()->id;
            $user_name=Auth::user()->name;
        }else{
            $user_id=$request->sender_id;
            $user_name=$request->sender_name;
        }
        $level = ProjectLevels::find($request->level_id);
        $data = new Message();
        $data->level_id=$request->level_id;
        $data->project_id=$level->project_id;
        $data->sender_id=$user_id;
        $data->sender_name=$user_name;
        $data->type=0;
        $data->message=$request->message;
//        $data->file=$request->file;
        $data->created_at=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d H:i:s');
        $data->save();

        //is read
        UserChatPermission::where('reciever_id','!=',$user_id)->where('type',0)->where('level_id',$level->id)->update([
            'is_read'=>0
        ]);
        UserChatPermission::where('type',1)->where('level_id',$level->id)->update([
            'is_read'=>0
        ]);

        $ids = UserChatPermission::where('level_id',$level->id)->where('reciever_id','!=',$user_id)->pluck('reciever_id')->ToArray();

        $token = User::whereIn('id',$ids)->pluck('token_id')->ToArray();

        $project = Project::find($level->project_id);
        array_push($token, $project->client->token_id );

        if($data->file == null){
            $dataNotifaction = array('id'=> $data->id , 'sender_id' => $data->sender_id ,'sender_name'=> $data->sender_name , 'type' => $data->type , 'message' => $data->message , 'project_name' => $level->project->name ,'project_id' => $data->project_id ,'level_id'=> $data->level_id , 'level_name' => $level->title , 'file'=> '' , 'created_at'=> $data->created_at);
        }else{

            $dataNotifaction = array('id'=> $data->id , 'sender_id' => $data->sender_id ,'sender_name'=> $data->sender_name , 'type' => $data->type , 'message' => $data->message , 'project_name' => $project->name  , 'project_id' => $data->project_id ,'level_id'=> $data->level_id , 'level_name' => $level->title , 'file'=> $data->file , 'created_at'=> $data->created_at);
        }
        $this->send($token , $level->project->name , $data->message , 5 , $dataNotifaction );
        //end is read
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );


        $pusher->trigger('MessageSent-channel-'.$request->level_id, 'App\Events\SendMessage', $data);
        return response()->json($data);

    }
    public function StoreChatMobile(Request $request){

        $rules = [
            'message' => 'nullable|string',
            'sender_name' => 'required|string',
            'level_id' => 'required|exists:project_levels,id',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $object = array('status'=>401 , 'msg'=>'Error ','ar_msg'=>'حدث خطأ','data'=>$validator->messages()->first());
            return response()->json($object);
        }


        if(Auth::check()){
            $user_id=Auth::user()->id;
            $user_name=Auth::user()->name;
        }else{
            $user_id=$request->sender_id;
            $user_name=$request->sender_name;
        }
        $level = ProjectLevels::find($request->level_id);
        $data = new Message();
        $data->level_id=$request->level_id;
        $data->project_id=$level->project_id;
        $data->sender_id=$user_id;
        $data->sender_name=$user_name;
        if($request->type){
            $data->type=$request->type;
        }else{
            $data->type=0;
        }
        $data->message=$request->message;
        $data->file=$request->file;
        $data->created_at=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d H:i:s');
        $data->save();

        //is read
        UserChatPermission::where('reciever_id','!=',$user_id)->where('type',0)->where('level_id',$level->id)->update([
            'is_read'=>0
        ]);
        UserChatPermission::where('type',1)->where('level_id',$level->id)->update([
            'is_read'=>0
        ]);

        $ids = UserChatPermission::where('level_id',$level->id)->where('reciever_id','!=',$user_id)->pluck('reciever_id')->ToArray();

        $token = User::whereIn('id',$ids)->pluck('token_id')->ToArray();

        $project = Project::find($level->project_id);
        if($data->type == 0){
        array_push($token, $project->client->token_id );
        }
        if($data->file == null){
            $dataNotifaction = array('id'=> $data->id , 'sender_id' => $data->sender_id ,'sender_name'=> $data->sender_name , 'type' => $data->type , 'message' => $data->message , 'project_name' => $level->project->name ,'project_id' => $data->project_id ,'level_id'=> $data->level_id , 'level_name' => $level->title , 'file'=> '' , 'created_at'=> $data->created_at);
        }else{

            $dataNotifaction = array('id'=> $data->id , 'sender_id' => $data->sender_id ,'sender_name'=> $data->sender_name , 'type' => $data->type , 'message' => $data->message , 'project_name' => $project->name  , 'project_id' => $data->project_id ,'level_id'=> $data->level_id , 'level_name' => $level->title , 'file'=> $data->file , 'created_at'=> $data->created_at);
        }
        $this->send($token , $level->project->name , $data->message , 5 , $dataNotifaction );
        //end is read
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );


        $pusher->trigger('MessageSent-channel-'.$request->level_id, 'App\Events\SendMessage', $data);
        $object = array('status'=>200 , 'msg'=>'success ','ar_msg'=>'تم بنجاح','data'=>$data);
        return response()->json($object);

    }

    public function send($tokens, $title="hello", $msg="helo msg", $type=5,$chat=null ){
//        $key = 'AAAA-3lLTNI:APA91bHfjq6BmKczrRM7XkwhtPMdf0JcVCTQQvsnDOmgac4lcYf_bxpVdryg_nQNFqog-6TT3hmvZIxP-vv3t8OKMBnCirPSyNH1JEXStzaQ-NnpoHXKvQm4d-EUcvOPz5sSLxRPWcOq';
        $key = 'AAAA7MITCVM:APA91bFxG1YuBa-5G6nYPwrn4KFrbKjtilNv-dlm5yXKOLJiGtMgdLSTCjYIY1i3M6Nf4au0r6b2mEL_MjfkGb1-haRJa-zZr1laU5uffby_y2n63IMaVgrh5u63aQRJZMnpJg-SAO5V';

        $fields = array
        (
            "registration_ids" => (array)$tokens,  //array of user token whom notification sent two
            "priority" => 10,
            'data' => [
                'title' => $title,
                'body' => $msg,
                'chat' => $chat,
                'type' => $type,
                'icon' => 'myIcon',
                'sound' => 'mySound'
            ],
            'notification' => [
                'title' => $title,
                'body' => $msg,
                'chat' => $chat,
                'type' => 3,
                'icon' => 'myIcon',
                'sound' => 'mySound'
            ],
            'vibrate' => 1,
            'sound' => 1
        );

        $headers = array
        (
            'accept: application/json',
            'Content-Type: application/json',
            'Authorization: key=' . $key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);

        //  var_dump($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
    public function getMessage(Request $request){
        $rules = [
            'user_id' => 'required|string',
            'level_id' => 'required|exists:project_levels,id',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $object = array('status'=>401 , 'msg'=>'Error ','ar_msg'=>'حدث خطأ','data'=>$validator->messages()->first());
            return response()->json($object);
        }
        $User = User::find($request->user_id);
        if($User->job_type == 3){
            $data = Message::where('level_id',$request->level_id)->OrderBy('id','desc')->paginate(10);

        }else{
        $data = Message::where('level_id',$request->level_id)->where('is_delete',0)->OrderBy('id','desc')->paginate(10);
        }
        $object = array('status'=>200 , 'msg'=>'success ','ar_msg'=>'تم بنجاح','data'=>$data);
        return response()->json($object);

    }

}
