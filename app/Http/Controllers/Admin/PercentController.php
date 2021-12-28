<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Percent;
use App\Models\PercentCategory;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PercentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('admin.setting.Percent.index', compact('id'));
    }

    public function button($id)
    {
        return view('admin/setting/Percent/button', compact('id'));
    }

    public function datatable(Request $request)
    {
        $data = Percent::where('cat_id', $request->id)->orderBy('id', 'asc');

        $data = $data->get();
        return Datatables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->editColumn('com_name', function ($row) {
                $name = ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->com_name . '</span>';
                return $name;
            })
            ->addColumn('percent_group', function ($row) {
                return $row->category ? $row->category->name : '';
            })
            ->addColumn('actions', function ($row) {
                $actions = '';
                $actions .= ' <a href="' . url("edit-percent/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> تعديل </a>';
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox', 'com_name'])
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
            'com_name' => 'required|string',
            'percent' => 'required|numeric|max:100',
            'cat_id' => 'required|exists:percent_category,id',
        ]);

        Percent::create($data);
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
        $permission = Percent::findOrFail($id);
        return view('admin.setting.Percent.edit', compact('permission'));

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
            'com_name' => 'required|string',
            'percent' => 'required|numeric|max:100',
            'cat_id' => 'required|exists:percent_category,id',
            'id' => 'required|exists:percent,id',
        ]);
        $user = Percent::whereId($request->id)->update($data);
        return redirect(url('percent-setting/'.$request->cat_id))->with('message', 'تم التعديل بنجاح ');

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
            Percent::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}
