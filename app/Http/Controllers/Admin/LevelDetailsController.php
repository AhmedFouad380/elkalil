<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\LevelDetails;
use App\Models\Percent;
use App\Models\PercentCategory;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LevelDetailsController extends Controller
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
    public function index($id)
    {
        return view('admin.setting.LevelDetails.index', compact('id'));
    }

    public function button($id)
    {
        return view('admin/setting/LevelDetails/button', compact('id'));
    }

    public function datatable(Request $request)
    {
        $data = LevelDetails::orderBy('sort', 'ASC')->where('level_id', $request->id);
        $data = $data->get();
        return Datatables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->editColumn('title', function ($row) {
                $name = ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->title . '</span>';
                return $name;
            })->editColumn('percent', function ($row) {
                $name = ' <span class="text-gray-800 text-hover-primary mb-1"> ' . $row->percent . ' %</span>';
                return $name;
            })
            ->addColumn('level', function ($row) {
                return $row->level ? $row->level->title : '';
            })
            ->addColumn('actions', function ($row) {
                $actions = '';
                $actions .= ' <a href="' . url("edit-details-level/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> تعديل </a>';
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox', 'title', 'percent'])
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
            'percent' => 'required|numeric|max:100',
            'level_id' => 'required|exists:level,id',
            'sort' => 'required|numeric',
            'is_pdf' => 'required|numeric',
            'values' => 'nullable',
            'question_type' => 'nullable'

        ]);
        $levels_percent = LevelDetails::where('level_id', $request->level_id)->sum('percent');
        $level = Level::where('id', $request->level_id)->first();
        if ($levels_percent + $request->percent > $level->percent) {
            return redirect()->back()->with('error', 'اجمالى نسب المراحل الداخلية اكبر من' . $level->percent);
        }
        if (!$request->question_type) {
            $data['question_type'] = 1;
        }
        $data['type'] = $level->type;
        $data['state'] = 0;
        $data['values'] = json_encode($request->values);


        LevelDetails::create($data);
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
        $permission = LevelDetails::findOrFail($id);
        return view('admin.setting.LevelDetails.edit', compact('permission'));

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
            'percent' => 'required|numeric|max:100',
            'level_id' => 'required|exists:level,id',
            'sort' => 'required|numeric',
            'is_pdf' => 'required|numeric',
            'values' => 'nullable',
            'question_type' => 'nullable'
        ]);
        $levels_percent = LevelDetails::where('level_id', $request->level_id)->sum('percent');
        $levels_details = LevelDetails::where('id', $request->id)->first();
        $level = Level::where('id', $request->level_id)->first();
        if ($levels_percent + $request->percent - $levels_details->percent > $level->percent) {
            return redirect()->back()->with('error', 'اجمالى نسب المراحل الداخلية اكبر من' . $level->percent);
        }
        if (!$request->question_type) {
            $data['question_type'] = 1;
        }
        $data['type'] = $level->type;
        $data['state'] = 0;
        if ($request->question_type == 2 || $request->question_type == 3 || $request->question_type == 5) {

            $data['values'] = json_encode($request->values);
        } else {
            $data['values'] = "[]";
        }

        $user = LevelDetails::whereId($request->id)->update($data);
        return redirect(url('level-details-setting/' . $request->level_id))->with('message', 'تم التعديل بنجاح ');

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
            LevelDetails::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}
