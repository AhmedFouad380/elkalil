<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branche;
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

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.employee_setting');
    }

    public function datatable(Request $request)
    {

        $data = User::orderBy('id', 'asc')->get();

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
                                   <br> <span>' . $row->email . '</span>';
                return $name;
            })->editColumn('is_active', function ($row) {

                $is_active = '<div class="badge badge-light-success fw-bolder">مفعل</div>';
                $not_active = '<div class="badge badge-light-danger fw-bolder">غير مفعل</div>';
                if ($row->is_active == 1) {
                    return $is_active;
                } else {
                    return $not_active;
                }
            })
            ->editColumn('users_group', function ($row) {
                return $row->userGroup ? $row->userGroup->title : '';
            })->editColumn('jop_type', function ($row) {
               if ($row->jop_type == 1){
                   return '<div class="badge badge-light-success fw-bolder">مشروع محدد</div>';
               }elseif($row->jop_type == 2){
                   return '<div class="badge badge-light-info fw-bolder"> فرع محدد</div>';
               }else{
                   return '<div class="badge badge-light-danger fw-bolder">كل الفروع</div>';

               }
            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("employee-edit/" . $row->id) . '" class="btn btn-active-light-info">تعديل</a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'users_group', 'is_active', 'jop_type'])
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
