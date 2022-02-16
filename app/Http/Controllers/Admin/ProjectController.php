<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Explan;
use App\Models\inbox;
use App\Models\Level;
use App\Models\LevelDetails;
use App\Models\Project;
use App\Models\ProjectContract;
use App\Models\ProjectPaid;
use App\Models\ProjectLevelDetails;
use App\Models\ProjectLevels;
use App\Models\ProjectOther;
use App\Models\User;
use App\Models\UserChatPermission;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Auth;
class ProjectController extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->userGroup->is_projects;
            if( $this->id  == 0 ){
                return redirect('/');
            }
            return $next($request);

        });

    }
    public  function  index(Request $request){
        if(Auth::user()->jop_type == 3){
            if(isset($request->contract_id)){
            $data = Project::where('projects.confirm',1)->orderBy('projects.confirm_date','desc');
            }else{
                $data = Project::where('confirm',1)->orderBy('confirm_date','desc');
            }
        }elseif(Auth::user()->jop_type == 2 ){

            if(isset($request->contract_id)){
                $data = Project::where('projects.confirm',1)->orderBy('projects.confirm_date','desc')->where('projects.state',Auth::user()->state);
            }else{
                $data = Project::where('confirm',1)->orderBy('confirm_date','desc')->where('state',Auth::user()->state);
            }
        }elseif(Auth::user()->jop_type == 1){
                $data = Project::where('projects.confirm',1)->orderBy('projects.confirm_date','desc')->
                rightJoin('user_permission','projects.id','=','user_permission.project_id')
                    ->where('user_permission.emp_id', Auth::user()->id)
            ->select('projects.*');

        }
        if(isset($request->minProgress)){
                $data->whereBetween('progress',[$request->minProgress,$request->maxProgress]);
        }
            if(isset($request->name)){
            $data->where('name','like','%'.$request->name.'%');
        }

        if(isset($request->phone)){
            $data->where('phone',$request->phone);
        }

        if(isset($request->country)){
            $data->where('state',$request->country);
        }
        if(isset($request->contract_id)){
            $data->leftJoin('project_contract','projects.id','=','project_contract.project_id')->where('project_contract.contract_id',$request->contract_id);
        }
        if(isset($request->from)){
            if($request->dateType == 1){
                $data->whereDate('confirm_date','>=',$request->from);
            }
        }
        if(isset($request->to)){
            if($request->dateType == 1){
                $data->whereDate('confirm_date','<=',$request->to);
            }
        }
       $data = $data->paginate(12);
        return view('admin.Project.index',compact('data'));
    }

    public function store(Request $request){
         $this->validate(request(), [
            'name' => 'required|string',
            'client_id' => 'required',
            'country' => 'required|',
            'state' => 'required|',
            'project_type' => 'required|',
            'area' => 'required',
            'confirm_date' => 'required',
            'contract_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',

        ]);

            try {
                $client = Client::find($request->client_id);
                $project = new Project();
                $project->name=$request->name;
                $project->phone=$client->phone;
                $project->email=$client->email;
                $project->country=$request->country;
                $project->state=$request->state;
                $project->know_us='';
                $project->project_type=$request->project_type;
                $project->area=$request->area;
                $project->is_customer=0;
                $project->is_contract=1;
                $project->is_accepted=1;
                $project->confirm=1;
                $project->is_created=1;
                $project->address_type=$request->address_type;
                $project->address_link=$request->address_link;

                $project->client_id=$request->client_id;
                $project->accept_date=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');
                $project->date=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');
                $project->confirm_date=$request->confirm_date;
                $project->lat=$request->lat;
                $project->lng=$request->lng;
                $project->client_id=$request->client_id;
                $project->created_by=Auth::user()->id;
                $project->save();
                // other
                $other = new ProjectOther;
                $other->project_id=$project->id;
                $other->save();

                // projectPaid
                $project_paid_data['project_id'] = $project->id;
                $project_paid = ProjectPaid::create($project_paid_data);

            //projectContract
                $con = Contract::find($request->contract_id);
                $contract = new ProjectContract();
                $contract->title=$con->title;
                $contract->project_id=$project->id;
                $contract->price=$con->price;
                $contract->template=$con->template;
                $contract->color=$con->color;
                $contract->contract_id=$con->id;
                $contract->save();

                // Create ProjectLevels
                $StanderLevels = Level::where('contract_id',$request->contract_id)->get();
                foreach($StanderLevels as $level){
                    $ProjectLevels = New ProjectLevels();
                    $ProjectLevels->title=$level->title;
                    $ProjectLevels->percent=$level->percent;
                    $ProjectLevels->contract_id=$level->contract_id;
                    $ProjectLevels->project_id=$project->id;
                    $ProjectLevels->project_contract_id=$contract->id;
                    $ProjectLevels->level_id=$level->id;
                    $ProjectLevels->sort=$level->sort;
                    $ProjectLevels->progress_time=$level->progress_time;
                    $ProjectLevels->save();
                    //Create LevelDetails
                    $levelsDetails = LevelDetails::where('level_id',$level->id)->get();
                    foreach($levelsDetails as $de){
                        $ProjectLevelDetails = New ProjectLevelDetails();
                        $ProjectLevelDetails->title=$de->title;
                        $ProjectLevelDetails->project_id=$project->id;
                        $ProjectLevelDetails->level_id=$ProjectLevels->id;
//                        $ProjectLevelDetails->date=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');
                        $ProjectLevelDetails->client_view=$de->client_view;
                        $ProjectLevelDetails->sort=$de->sort;
                        $ProjectLevelDetails->question_type=$de->question_type;
                        $ProjectLevelDetails->values=$de->values;
                        $ProjectLevelDetails->is_pdf=$de->is_pdf;
                        $ProjectLevelDetails->emp_id=0;
                        $ProjectLevelDetails->save();
                    }
                    // chat permission
                    $users = User::where('state',$request->state)->get();
                    foreach($users as $user){
                        $dataa = array('reciever_id'=>$user->id , 'type' => 0 ,'project_id'=> $project->id, 'level_id' => $ProjectLevels->id ,'is_read' => 1 );
                        UserChatPermission::insert($dataa);
                    }
                    $UserChatPermission = array('level_id'=> $ProjectLevels->id , 'reciever_id' => $request->client_id ,'type' =>1  , 'project_id' => $project->id );
                    UserChatPermission::insert($UserChatPermission);

                }

            } catch (Exception $e) {
                return back()->with('message', 'Failed');
            }
        return back()->with('message', 'Success');


    }

    public function project_details($id){
        $data = Project::find($id);
        if(Auth::user()->jop_type == 1 ){
            $levels = ProjectLevels::where('project_levels.project_id', $id)->
            Join('user_permission','project_levels.id','=','user_permission.level_id')
                ->where('user_permission.emp_id', Auth::user()->id)->select('project_levels.*')
            ->get();
        }else {
            $levels = ProjectLevels::where('project_id', $id)->get();
        }
        return view('admin.Project.details',compact('data','levels'));

    }
    public function level_Details($id){
        $level = ProjectLevels::find($id);
        $data = Project::find($level->project_id);

        $levelDetails= ProjectLevelDetails::where('level_id',$id)->get();
        return view('admin.Project.level_details',compact('data','level','levelDetails','id'));

    }

    public function projectFiles($id ,Request $request){

        $data = Project::find($id);
        $files = ProjectLevelDetails::where('project_id',$id)->where('is_pdf',1)->where('pdf','!=',null)->where('pdf','!=','');

        if(isset($request->level_id)){
        $files->where('level_id',$request->level_id);
        }
        if(isset($request->level_detail_id)){
        $files->where('id',$request->level_detail_id);
        }
        $files = $files->get();
        return view('admin.Project.projectFiles',compact('data','id','files'));
    }

    public function projectExplan($id){

        $data = Project::find($id);

        $explans = Explan::where('project_id',$id)->OrderBy('id','desc')->get();
        return view('admin.Project.explans',compact('data','id','explans'));

    }

    public function projectEmployes($id){

        $data = Project::find($id);

        return view('admin.Project.employes',compact('data','id'));

    }
    public function assign_users($id){

        $level = ProjectLevels::find($id);

        $data = Project::find($level->project_id);


        return view('admin.Project.assign_users',compact('data','id','level'));
    }

    public function assgin_new_user(Request $request){
        $this->validate(request(), [
            'level_id' => 'required',
            'project_id' => 'required',
            'emp_id' => 'required',

        ]);
        $Project = Project::find($request->project_id);
        $client = User::find($request->emp_id);
        if(UserPermission::where('emp_id',$request->emp_id)->where('level_id',$request->level_id)->count() > 0){
            return back()->with('error_message','هذا المستخدم موجود بالفعل ');
        }
        $data = new UserPermission();
        $data->level_id=$request->level_id;
        $data->project_id=$request->project_id;
        $data->emp_id=$request->emp_id;
        $data->save();

        $chat = new UserChatPermission();
        $chat->reciever_id=$request->emp_id;
        $chat->type=0;
        $chat->level_id=$request->level_id;
        $data->project_id=$request->project_id;
        $data->save();


        $inbox = array(
            'title' => " تم تكليفك بالاعمال في المشروع   ",
            'comments' => 'تم تكليفك بالاعمال في مشروع' . $Project->name,
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'sender_id' => \Illuminate\Support\Facades\Auth::user()->id,
            'sender_name' => Auth::user()->name,
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
        'emp_id' => Auth::user()->id,
        'emp_name' => Auth::user()->name,
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
        return back()->with('message','Success');



}
    public function AddGeneralSupervisor(Request $request){
        $this->validate(request(), [
            'level_id' => 'required',
            'project_id' => 'required',
            'emp_id' => 'required',
        ]);
        $Project = Project::find($request->project_id);
        $client = User::find($request->emp_id);
        if(UserPermission::where('emp_id',$request->emp_id)->where('level_id',$request->level_id)->count() > 0){
            return back()->with('error_message','هذا المستخدم موجود بالفعل ');
        }
        $data = new UserPermission();
        $data->level_id=$request->level_id;
        $data->project_id=$request->project_id;
        $data->emp_id=$request->emp_id;
        $data->user_type=1;
        $data->save();

        $chat = new UserChatPermission();
        $chat->reciever_id=$request->emp_id;
        $chat->type=0;
        $data->user_type=1;
        $chat->level_id=$request->level_id;
        $data->project_id=$request->project_id;
        $data->save();


        $inbox = array(
            'title' => " تم تكليفك بالاعمال في المشروع   ",
            'comments' => 'تم تكليفك بالاعمال في مشروع' . $Project->name,
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'sender_id' => \Illuminate\Support\Facades\Auth::user()->id,
            'sender_name' => Auth::user()->name,
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
            'emp_id' => Auth::user()->id,
            'emp_name' => Auth::user()->name,
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

    public function remove_assign_user(Request $request){

        $this->validate(request(), [
            'level_id' => 'required',
            'project_id' => 'required',
            'emp_id' => 'required',

        ]);
        $Project = Project::find($request->project_id);
        $client = User::find($request->emp_id);
        try{
         UserPermission::where('emp_id',$request->emp_id)->where('level_id',$request->level_id)->delete();
         UserChatPermission::where('reciever_id',$request->emp_id)->where('level_id',$request->level_id)->delete();

            $d_explan = array(
                'title' => 'تم الغاء تكليف موظف للمشروع ',
                'comments' => 'تم الغاء تكليف الموظف   '  . $client->name ,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'emp_id' => Auth::user()->id,
                'emp_name' => Auth::user()->name,
                'project_id' => $request->project_id
            );
            Explan::insert($d_explan);

        } catch (Throwable $e) {
            return back()->with('error_message','عفوا حذث خطأ');

        }
        return response()->json(['message' => 'Success']);

    }
    public function DeleteProject(Request $request){

        Project::where('id', $request->id)->delete();
        ProjectLevelDetails::where('project_id',$request->id)->delete();
        ProjectLevels::where('project_id',$request->id)->delete();
        return response()->json(['message' => 'Success']);

    }
}
