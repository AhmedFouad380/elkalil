<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Explan;
use App\Models\Project;
use App\Models\ProjectContract;
use Illuminate\Http\Request;
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
            })
            ->editColumn('date', function ($row) {
                return \Carbon\Carbon::parse($row->date)->format('Y-m-d H:i');

            })
            ->addColumn('type', function ($row) {

                return Contract::find($row->projectContract->contract_id)->title;
            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("Contracts-edit/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> تعديل </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'date', 'type'])
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

}
