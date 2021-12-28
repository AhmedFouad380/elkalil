<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.UserPermission.index');
    }

    public function datatable(Request $request)
    {
        $data = UserGroup::orderBy('id', 'asc');

        $data = $data->get();
        return Datatables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })->addColumn('users_count', function ($row) {
                $users_count = '';
                $users_count .= ' <span class="text-light-info-800 text-hover-primary mb-1">' . $row->users->count() . '</span>';;
                return $users_count;
            })
            ->editColumn('name', function ($row) {
                $name = ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->title . '</span>';
                return $name;
            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("edit-permission/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> تعديل </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'users_count'])
            ->make();

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
            'title' => 'required|string',
            'is_client_order' => 'required|in:0,1',
            'is_contracting' => 'required|in:0,1',
            'is_projects' => 'required|in:0,1',
            'is_report' => 'required|in:0,1',
            'is_financial' => 'required|in:0,1',
            'is_settings' => 'required|in:0,1',
            'is_progressTime' => 'required|in:0,1',

        ]);

        $data['type'] = 0;
        UserGroup::create($data);
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
        $permission = UserGroup::findOrFail($id);
        return view('admin.setting.UserPermission.edit', compact('permission'));

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
            'title' => 'required|string',
            'id' => 'required|exists:users_group,id',
            'is_client_order' => 'required|in:0,1',
            'is_contracting' => 'required|in:0,1',
            'is_projects' => 'required|in:0,1',
            'is_report' => 'required|in:0,1',
            'is_financial' => 'required|in:0,1',
            'is_settings' => 'required|in:0,1',
            'is_progressTime' => 'required|in:0,1',

        ]);
        $user = UserGroup::whereId($request->id)->update($data);
        return redirect(url('permission_setting'))->with('message', 'تم التعديل بنجاح ');

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
            UserGroup::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}
