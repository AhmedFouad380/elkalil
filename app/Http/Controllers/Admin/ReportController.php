<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Income;
use App\Models\Project;
use App\Models\ProjectPaid;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function client_search(Request $request){
        $data = Income::OrderBy('id','desc');
        if(isset($request->from)){
            $data->where('created_at','>=',$request->from);
        }
        if($request->to){
            $data->where('created_at','<=',$request->to);
        }
        if($request->project_id){
            $data->where('project_id',$request->project_id);
        }
        $data->get();
        if(isset($request->project_id)){
        $Project = Project::findOrFail($request->project_id);
        }else{
            $Project = null;
        }
        return view('admin.reports.clientSearch.index',compact('Project','data'));
    }

    public function datatable(Request $request){

        $data = Income::orderBy('id', 'asc');
        if($request->from){
            $data->where('created_at','>=',$request->from);
        }
        if($request->to){
            $data->where('created_at','<=',$request->to);
        }
        if($request->project_id){
            $data->where('project_id',$request->project_id);
        }else{
            $data->where('project_id',0);

        }
        $data = $data->get();
        $Project = Project::findOrFail($request->project_id);
        $data->project = $Project;
        return DataTables::of($data)
            ->setRowData([
                'DT_RowIndex' => '1',
                'created_at' => $Project->confirm_date,
                'details' => 'مبلغ التعاقد',
                'project_name' => $Project->name,
                'daen' => 0,
                'amount' => 0,
            ])

            ->editColumn('project_name', function ($row) {
                $name = $row->project->name;
                return $name;
            })

            ->addColumn('daen', function ($row) {
                return '';

            })->addIndexColumn()
            ->rawColumns(['daen', 'checkbox', 'project_name', 'details', 'created_at','amount'])
            ->make();
    }

    public function Project_search(Request $request){
        if(isset($request->project_id)){
            $Project = Project::findOrFail($request->project_id);
        }else{
            $Project = null;
        }


        return view('admin.reports.ProjectSearch.index',compact('Project'));
    }

    public function datatable2(Request $request){

        $data = Income::orderBy('id', 'asc');
        if($request->from){
            $data->where('created_at','>=',$request->from);
        }
        if($request->to){
            $data->where('created_at','<=',$request->to);
        }
        if($request->project_id){
            $data->where('project_id',$request->project_id);
        }else{
            $data->where('project_id',0);

        }
        $data = $data->get();
        $Project = Project::findOrFail($request->project_id);
        $data->project = $Project;
        return DataTables::of($data)
            ->setRowData([
                'DT_RowIndex' => '1',
                'created_at' => $Project->confirm_date,
                'details' => 'مبلغ التعاقد',
                'project_name' => $Project->name,
                'daen' => 0,
                'amount' => 0,
            ])

            ->editColumn('project_name', function ($row) {
                $name = $row->project->name;
                return $name;
            })

            ->addColumn('daen', function ($row) {
                return '';

            })->addIndexColumn()
            ->rawColumns(['daen', 'checkbox', 'project_name', 'details', 'created_at','amount'])
            ->make();
    }
}
