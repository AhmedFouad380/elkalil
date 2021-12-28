<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
                $actions = ' <a href="' . url("employee-edit/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> تعديل </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'date', 'type'])
            ->make();

    }
}
