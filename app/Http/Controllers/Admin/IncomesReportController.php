<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branche;
use App\Models\Income;
use App\Models\Level;
use App\Models\Project;
use App\Models\ProjectLevels;
use App\Models\ProjectPaid;
use App\Models\User;
use App\Models\UserChatPermission;
use App\SmsMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class IncomesReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = \Illuminate\Support\Facades\Auth::user()->userGroup->is_report;
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
        $projects = Project::where('is_accepted', 1)->where('is_archive', 0)->get();
        foreach ($projects as $project) {
            $paid = 0;
            $remain = 0;
            $total = ProjectPaid::where('project_id', $project->id)->first();
//            if ($total){
//                if ($total->paid && $total->paid !=''){
            $paid_results = Income::where('project_id', $project->id)->get();
            foreach ($paid_results as $pad) {
                $paid += $pad->amount;
            }
            $remain = $total->paid - $paid;
            $term_list[] = array('project_name' => $project->name, 'total' => $total->paid, 'paid' => $paid, 'remain' => $remain);

//                }
//            }
            $total_paid[] = $paid;
            $total_remain[] = $remain;
        }
        $total_paid = array_sum($total_paid);
        $total_remain = array_sum($total_remain);

        return view('admin.reports.incomeReport.index', compact('term_list', 'total_paid', 'total_remain'));
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phone' => 'required|unique:users',
            'jop_type' => 'required|in:1,2,3',
            'users_group' => 'required|exists:users_group,id',
            'branche' => 'required|exists:branche,id',
            'state' => 'required|exists:state,id',
            'address' => 'required|string',
            'is_active' => 'nullable|string',

        ]);

        $data['date'] = date("Y-m-d H:i:s");
        $data['password'] = sha1($request->password);
        $data['ref_code'] = rand(1111, 9999);
        $data['firebase_type'] = 0;
        $data['token_id'] = " ";
        $data['msg'] = " ";


        $user = User::create($data);


        if ($request->jop_type == 2) {
            $projects = Project::where('state', $request->state)->get();
            foreach ($projects as $project) {
                $levels = ProjectLevels::where('project_id', $project->id)->get();
                foreach ($levels as $level) {
                    $dataChatPermission = array('reciever_id' => $user->id, 'type' => 0, 'project_id' => $project->id, 'level_id' => $level->id, 'is_read' => 1);
                    UserChatPermission::create($dataChatPermission);
                }
            }
        }

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
    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.setting.employee.edit_employee', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $this->validate(request(), [
            'name' => 'required|string',
            'id' => 'required|exists:users,id',
            'email' => 'required|email|unique:users,email,' . $request->id,
//            'password' => 'nullable|confirmed',
            'phone' => 'required|unique:users,phone,' . $request->id,
            'jop_type' => 'required|in:1,2,3',
            'users_group' => 'required|exists:users_group,id',
            'branche' => 'required|exists:branche,id',
            'state' => 'required|exists:state,id',
            'address' => 'required|string',
            'is_active' => 'nullable|string',

        ]);


        if ($request->password && $request->password != "" && $request->password != null) {
            $data['password'] = sha1($request->password);
        }

        $user = User::whereId($request->id)->update($data);


        if ($request->jop_type == 2) {
            $projects = Project::where('state', $request->state)->get();
            foreach ($projects as $project) {
                $levels = ProjectLevels::where('project_id', $project->id)->get();
                foreach ($levels as $level) {
                    $dataChatPermission = array('reciever_id' => $request->id, 'type' => 0, 'project_id' => $project->id, 'level_id' => $level->id, 'is_read' => 1);
                    UserChatPermission::create($dataChatPermission);
                }
            }
        }

        return redirect(url('employee_setting'))->with('message', 'تم التعديل بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            User::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }

    public function getBranch($id)
    {
        $data = Branche::where('state', $id)->pluck('id', 'title');
        return response($data);
    }
}
