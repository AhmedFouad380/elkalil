<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\Project;
use App\Models\ProjectPaid;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function client_search(Request $request){
        $query = Income::OrderBy('id','desc');
        if(isset($request->from)){
            $query->where('created_at','>=',$request->from);
        }
        if($request->to){
            $query->where('created_at','<=',$request->to);
        }
        if($request->project_id){
            $query->where('project_id',$request->project_id);
        }else{}
        $data = $query->get();
        if(isset($request->project_id)){
        $Project = Project::findOrFail($request->project_id);
        }else{
            $Project = null;
        }
        $incomes = $query->paginate(10);
        return view('admin.reports.clientSearch.index',compact('Project','data','incomes'));
    }

    public function datatable(Request $request){

        $query = Income::orderBy('id', 'asc');
        if($request->from){
            $query->where('created_at','>=',$request->from);
        }
        if($request->to){
            $query->where('created_at','<=',$request->to);
        }
        if($request->project_id){
            $query->where('project_id',$request->project_id);
        }
        $data = $query->get();
        $Project = Project::findOrFail($request->project_id);

        return DataTables::of($data)


            ->editColumn('project_name', function ($row) {
                $name = $row->project->name;
                return $name;
            })

            ->addColumn('daen', function ($row) {
                return '';

            })->addIndexColumn()
            ->setRowData([
                'DT_RowIndex' => '1',
                'created_at' => '',
                'details' => 'مبلغ التعاقد',
                'project_name' => 'aaa',
                'daen' => 0,
                'amount' => 0,
            ])
            ->rawColumns(['daen', 'checkbox', 'project_name', 'details', 'created_at','amount'])
            ->make();
    }

    public function Project_search(Request $request){

        $query = Income::OrderBy('id','desc');
        if(isset($request->from)){
            $query->where('created_at','>=',$request->from);
        }
        if($request->to){
            $query->where('created_at','<=',$request->to);
        }
        if($request->project_id){
            $query->where('project_id',$request->project_id);
        }else{}
        $data = $query->get();

        $incomes = $query->paginate(10);

        // out comes
        $query2 = Outcome::OrderBy('id','desc');
        if(isset($request->from)){
            $query2->where('created_at','>=',$request->from);
        }
        if($request->to){
            $query2->where('created_at','<=',$request->to);
        }
        if($request->project_id){
            $query2->where('project_id',$request->project_id);
        }else{}
        $data2 = $query2->get();

        $outcomes = $query2->paginate(10);

        if(isset($request->project_id)){
            $Project = Project::findOrFail($request->project_id);
        }else{
            $Project = null;
        }


        return view('admin.reports.ProjectSearch.index',compact('Project','data','incomes','data2','outcomes'));
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
