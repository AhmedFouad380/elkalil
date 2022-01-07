<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\ProjectContract;
use App\Models\ProjectLevelDetails;
use App\Models\ProjectLevels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
class ProjectLevelController extends Controller
{
    public function  store_level(Request $request){

        $lvl = ProjectLevels::where('project_id',$request->project_id)->OrderBy('id','desc')->first();
        $projectContract = ProjectContract::where('project_id',$request->project_id)->first();
        $totalPercent = ProjectLevels::where('project_id',$request->project_id)->sum('percent');
        $total = $totalPercent + $request->percent;
        if($total > 100){
            return back()->with('error_message', 'عفوا نسبة المرحلة اكبر من المسموح به ');
        }
        $data = new ProjectLevels();
        $data->title=$request->name;
        $data->percent=$request->percent;
        $data->project_contract_id=$projectContract->id;
        $data->project_id=$request->project_id;
        $data->created_by=Auth::user()->id;
        $data->emp_id=Auth::user()->id;
        $data->sort=$lvl->sort + 1 ;
        $data->save();

        return back()->with('message', 'Success');

    }

    public function CompleteLevel(Request $request){
        $data = ProjectLevels::find($request->id);
        $data->auto_complete=1;
        $data->save();
        return response()->json(['message' => 'Success']);

    }

    public function edit_LevelDetails(Request $request){

            $data = ProjectLevelDetails::find($request->id);

        return view('admin.Project.levelDetailsModel',compact('data'));

    }

    public function AnswerLevelDetails(Request $request){

        $data = ProjectLevelDetails::find($request->id);
        if($data->question_type == 1 || $data->question_type == 2 ){
            $data->answer=$request->answer;
        }elseif($data->question_type == 3){
            $data->asnwer=implode('|',$request->answer);
        }elseif($data->question_type == 4){
            $imageName = time().'.'.$request->answer->extension();
            $path = "https://alkhalilsys.com/images/";
//            $request->image->store('http://alkhalilsys.com/images/', $imageName);
            Storage::disk('public2')->put('images', $imageName);
            $data->answer=$imageName;
        }elseif($data->question_type == 5){
            $data->answer=$request->answer;
            $data->otherAnswer=$request->otherAnswer;
        }
        if(isset($request->img)){
            $imageName = time().'.'.$request->img->extension();
            $path = "https://alkhalilsys.com/images/";
//            $request->image->store('http://alkhalilsys.com/images/', $imageName);
            Storage::disk('public2')->put('images', $imageName);
            $data->img=$imageName;

        }
        $data->state = 1;
        $data->save();
        return back()->with('message', 'Success');

    }
}
