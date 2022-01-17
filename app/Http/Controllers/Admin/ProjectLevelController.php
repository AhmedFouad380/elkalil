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
    public function changeState(Request $request){
        $data = ProjectLevelDetails::find($request->id);
        $data->state = 0;
        $data->date = null;
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

//            $imageName = time().'.'.$request->img->extension();
//            $path = "https://alkhalilsys.com/images/";
////            $request->image->store('http://alkhalilsys.com/images/', $imageName);
//            Storage::disk('public2')->put('images', $imageName);
            $imageName =   upload_multiple($request->img,'images');
            $data->img=$imageName;

        }elseif($data->question_type == 5){

            $data->answer=$request->answer;
            $data->otherAnswer=$request->otherAnswer;

        }
        if(isset($request->pdf)){
            $files = [];
            foreach($request->pdf as $file) {
//                 $imageName = Auth::user()->id . '@' . \Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d') . '@'. Storage::disk('public2')->put("", $file);
//                $path = "https://alkhalilsys.com/images/";
////            $request->image->store('http://alkhalilsys.com/images/', $imageName);
//                Storage::disk('public2')->put('images', $imageName);
                $imageName2 =  upload_multiple($file,'images');
                $data->img=$imageName2;

//                $imageName = Auth::user()->id . '@' . \Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d') . '@'. time() . '.' .$file->extension();
//                $path = "https://alkhalilsys.com/images/";
////              $request->image->store('http://alkhalilsys.com/images/', $imageName);
//                Storage::disk('public2')->put('images', $imageName);
                $imageName =  upload_multiple2($file,'images');
                 $files[]=$imageName;
            }
            $data->pdf=$files;

        }
        $data->state = 1;
        $data->date=\Carbon\Carbon::now('Asia/Riyadh')->format('Y-m-d');

        $data->save();
        return back()->with('message', 'Success');

    }
    public function store_new_levelDetail(Request $request){

        $LastDetails = ProjectLevelDetails::where('level_id',$request->level_id)->OrderBy('id','desc')->first();
        $level = ProjectLevels::find($request->level_id);
        $totalPercent = ProjectLevelDetails::where('level_id',$request->level_id)->sum('percent');
        $total = $totalPercent + $request->percent;
        if($total > $level->percent){
            return back()->with('error_message', 'عفوا نسبة المرحلة اكبر من المسموح به ');
        }
        $data = new ProjectLevelDetails();
        $data->title=$request->name;
        $data->type=1;
        $data->percent=$request->percent;
        if($request->is_pdf == 1){
        $data->is_pdf=$request->is_pdf;
        }else{
            $data->is_pdf=0;

        }
        $data->level_id=$request->level_id;
        $data->project_id=$request->project_id;
        $data->UserAdded=1;
        $data->emp_id=Auth::user()->id;
        $data->sort=$LastDetails->sort + 1 ;
        $data->save();

        return back()->with('message', 'Success');

    }

    public function Store_ProgressTime(Request $request){

        $data = ProjectLevels::find($request->level_id);
        $data->progress_time=$request->progress_time;
        $data->save();
        return back()->with('message', 'Success');

    }

    public function GetLevelDetails($id){
        $data = ProjectLevelDetails::where('level_id',$id)->pluck('id','title');
        return response()->json($data);
    }
}
