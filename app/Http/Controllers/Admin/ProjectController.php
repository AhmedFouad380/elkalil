<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Level;
use App\Models\LevelDetails;
use App\Models\Project;
use App\Models\ProjectContract;
use App\Models\ProjectLevelDetails;
use App\Models\ProjectLevels;
use App\Models\ProjectOther;
use App\Models\User;
use App\Models\UserChatPermission;
use Illuminate\Http\Request;
use Auth;
class ProjectController extends Controller
{
    public  function  index(Request $request){
        if(Auth::user()->jop_type == 3){
            $data = Project::orderBy('id','desc');
        }elseif(Auth::user()->jop_type == 2 ){
            $data = Project::orderBy('id','desc')->where('state',Auth::user()->state);
        }elseif(Auth::user()->jop_type == 1){
            $data = Project::orderBy('id','desc')->join('user_permission', 'user_permission.project_id = projects.id and user_permission.emp_id = '.Auth::user()->id, 'right');
        }

        if(isset($request->name)){
            $data->where('name','like','%'.$request->name.'%');
        }

        if(isset($request->phone)){
            $data->where('phone',$request->phone);
        }

        if(isset($request->state)){
            $data->where('state',$request->state);
        }
        if(isset($request->contract_id)){
            $data->join('project_contract','project_contract.project_id','projects.id')->where('project_contract.contract_id',$request->contract_id);
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
       $data = $data->where('confirm',1)->paginate(12);
        return view('admin.Project.index',compact('data'));
    }

    public function store(Request $request){
        $data = $this->validate(request(), [
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
                        $ProjectLevelDetails->date=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');
                        $ProjectLevelDetails->client_view=$de->client_view;
                        $ProjectLevelDetails->sort=$de->sort;
                        $ProjectLevelDetails->question_type=$de->question_type;
                        $ProjectLevelDetails->values=$de->values;
                        $ProjectLevelDetails->emp_id=0;
                        $ProjectLevelDetails->save();
                    }
                    // chat permission
                    $users = User::where('state',$request->state)->get();
                    foreach($users as $user){
                        $dataa = array('reciever_id'=>$user->id , 'type' => 0 ,'project_id'=> $project->id, 'level_id' => $ProjectLevels->id ,'is_read' => 1 );
                        UserChatPermission::insert($dataa);
                    }
                    $UserChatPermission = array('level_id'=> $ProjectLevels->id , 'reciever_id' => $request->client_id ,'type' =>1  , 'project_id' => $project->i );
                    UserChatPermission::insert($UserChatPermission);

                }

            } catch (Exception $e) {
                return back()->with('message', 'Failed');
            }
        return back()->with('message', 'Success');


    }

    public function project_details($id){
        $data = Project::find($id);
        $levels = ProjectLevels::where('project_id',$id)->get();

        return view('admin.Project.details',compact('data','levels'));

    }
    public function level_Details($id){
        $level = ProjectLevels::find($id);
        $data = Project::find($level->project_id);

        $levelDetails= ProjectLevelDetails::where('level_id',$id)->get();
        return view('admin.Project.level_details',compact('data','level','levelDetails'));

    }
}
