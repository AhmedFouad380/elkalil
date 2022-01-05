<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\PercentCategory;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContractTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.ContractCategory.index');
    }

    public function datatable(Request $request)
    {
        $data = Contract::orderBy('id', 'asc');

        $data = $data->get();
        return Datatables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->addColumn('Levels', function ($row) {
                $users_count = '';
                $users_count .= ' <span class="text-light-info-800 text-hover-primary mb-1">';
                $users_count .= '<a href="' . url("level-setting/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-eye"></i> ' . $row->Levels->count() . '</span>' . ' </a>';
                return $users_count;
            })
            ->editColumn('title', function ($row) {
                $name = ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->title . '</span>';
                return $name;
            })->editColumn('color', function ($row) {
                $name = '<input type="color" disabled value="' . $row->color . '">';
                return $name;
            })
            ->addColumn('actions', function ($row) {
                $actions = '';
                $actions .= ' <a href="' . url("edit-contract/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> تعديل </a>';

                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'title', 'color','Levels'])
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
            'color' => 'required|string',
            'price' => 'required|string',
            'template' => 'required|string',

        ]);

        Contract::create($data);
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
        $permission = Contract::findOrFail($id);
        return view('admin.setting.ContractCategory.edit', compact('permission'));

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
            'color' => 'required|string',
            'price' => 'required|string',
            'template' => 'required|string',
            'id' => 'required|exists:contract,id',
        ]);
        $user = Contract::whereId($request->id)->update($data);
        return redirect(url('contract_setting'))->with('message', 'تم التعديل بنجاح ');

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
            Contract::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}
