<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PercentCategory;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PercentCategoryController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->userGroup->is_settings;
            if( $this->id  == 0 ){
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
        return view('admin.setting.PercentCategory.index');
    }

    public function datatable(Request $request)
    {
        $data = PercentCategory::orderBy('id', 'asc');
        $data = $data->get();
        return Datatables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })->addColumn('percent', function ($row) {
                $users_count = '';
                $users_count .= ' <span class="text-light-info-800 text-hover-primary mb-1">';
                $users_count .= '<a href="' . url("percent-setting/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-eye"></i> ' . $row->percent->count() . '</span>' . ' </a>';
                return $users_count;
            })
            ->editColumn('name', function ($row) {
                $name = ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</span>';
                return $name;
            })
            ->addColumn('actions', function ($row) {
                $actions = '';
                $actions .= ' <a href="' . url("edit-percent-category/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> ?????????? </a>';

                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'percent'])
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
            'name' => 'required|string',


        ]);

        PercentCategory::create($data);
        return redirect()->back()->with('message', '???? ?????????????? ?????????? ');

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
        $permission = PercentCategory::findOrFail($id);
        return view('admin.setting.PercentCategory.edit', compact('permission'));

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
            'id' => 'required|exists:percent_category,id',
        ]);
        $user = PercentCategory::whereId($request->id)->update($data);
        return redirect(url('percent-category_setting'))->with('message', '???? ?????????????? ?????????? ');

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
            PercentCategory::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}
