<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branche;
use App\Models\Income;
use App\Models\Level;
use App\Models\Project;
use App\Models\ProjectLevels;
use App\Models\User;
use App\Models\UserChatPermission;
use App\SmsMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class IncomeRecieptsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = \Illuminate\Support\Facades\Auth::user()->userGroup->is_financial;
            if ($this->id == 0) {
                return redirect('/');
            }
            return $next($request);

        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.incomeReciepts.index');
    }

    public function datatable(Request $request)
    {
        $data = Income::orderBy('id', 'desc');
        $data = $data->get();
        return Datatables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->editColumn('amount', function ($row) {
                return $row->amount;
            })->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat("Y-m-d");
            })->editColumn('type', function ($row) {
                $is_active = '<div class="badge badge-light-dark fw-bolder">نقدي</div>';
                $not_active = '<div class="badge badge-light-primary fw-bolder">تحويل بنكي</div>';
                if ($row->type == 1) {
                    return $is_active;
                } else {
                    return $not_active;
                }
            })
            ->rawColumns(['checkbox', 'project', 'type'])
            ->make();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required',
            'details' => 'required',
            'type' => 'required|in:1,2',
            'created_at' => 'required|date',


        ]);

        $data['date'] = date("Y");
        $project = Project::whereId($request->project_id)->first();
        $data['project_name'] = $project->name;
        $user = Income::create($data);
        return redirect()->back()->with('message', 'تم الاضافة بنجاح ');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Income::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }


}
