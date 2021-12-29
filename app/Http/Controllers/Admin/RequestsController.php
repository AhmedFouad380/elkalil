<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Explan;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;
class RequestsController extends Controller
{
    public function index()
    {
        return view('admin.Requests.index');
    }

    public function datatable(Request $request)
    {
        $data = Project::where('is_accepted',2)->orderBy('id', 'asc')->get();;
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
            })
            ->editColumn('date', function ($row) {
                    return \Carbon\Carbon::parse($row->date)->format('Y-m-d H:i');

            })
            ->addColumn('type', function ($row) {

                return Contract::find($row->projectContract->contract_id)->title;
            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("Requests-edit/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> تعديل </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'date', 'type'])
            ->make();

    }
    public function edit($id){

        $data = Project::findOrFail($id);
        $explans = Explan::OrderBy('id','desc')->where('project_id',$id)->get();
            return view('admin.Requests.edit',compact('data','explans'));
    }



    public function updateLocation(Request $request){

        $data = Project::FindOrFail($request->id);
        $data->lat=$request->lat;
        $data->lng=$request->lng;
        $data->save();
        $explan = 'تم تعديل موقع المشروع ';
        Explan::create([
            'title' => $explan,
            'comments' => $explan,
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_name'=>Auth::user()->name,
            'emp_id'=>Auth::user()->id,
            'project_id'=>$request->id
        ]);
        return back()->with('message','Success');
    }

    public function AcceptProject(Request $request){


        try {
            $data = Project::FindOrFail($request->id);
            $data->is_accepted = 1;
            $data->save();
            Explan::create([
                'title' => 'تم قبول المشروع',
                'comments' => 'تم قبول المشروع',
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'emp_name'=>Auth::user()->name,
                'emp_id'=>Auth::user()->id,
                'project_id'=>$request->id
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }

    public function RejectProject(Request $request){


        try {
            $data = Project::FindOrFail($request->id);
            $data->is_accepted = 0;
            $data->save();
            Explan::create([
                'title' => 'تم رفض المشروع',
                'comments' => 'تم رفض المشروع',
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'emp_name'=>Auth::user()->name,
                'emp_id'=>Auth::user()->id,
                'project_id'=>$request->id
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}