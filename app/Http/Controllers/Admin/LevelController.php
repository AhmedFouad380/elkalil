<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Percent;
use App\Models\PercentCategory;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('admin.setting.Level.index', compact('id'));
    }

    public function button($id)
    {
        return view('admin/setting/Level/button', compact('id'));
    }

    public function datatable(Request $request)
    {
        $data = Level::orderBy('sort', 'ASC')->where('contract_id', $request->id);
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
            })->editColumn('type', function ($row) {
                if ($row->type == 1) {
                    $name = ' <span class="text-gray-800 text-hover-primary mb-1">مرحلة تفاصيل داخلية</span>';
                } elseif ($row->type == 2) {
                    $name = ' <span class="text-gray-800 text-hover-primary mb-1">مرحلة استبيانات</span>';
                } else {
                    $name = ' <span class="text-gray-800 text-hover-primary mb-1">مرحلة مرفقات المشروع</span>';
                }
                return $name;
            })
            ->addColumn('contract', function ($row) {
                return $row->contract ? $row->contract->title : '';
            })
            ->addColumn('actions', function ($row) {
                $actions = '';
                $actions .= ' <a href="' . url("edit-level/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> تعديل </a>';
                $actions .= ' <a href="' . url("level-details-setting/" . $row->id) . '" class="btn btn-active-success"><i class="bi bi-subtract"></i> المراحل الداخلية </a>';
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox', 'type', 'title', 'percent'])
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
            'contract_id' => 'required|exists:contract,id',
            'type' => 'required|in:1,2,3',
            'sort' => 'required|numeric',
            'progress_time' => 'required|numeric',

        ]);
        $levels_percent = Level::where('contract_id', $request->contract_id)->sum('percent');
        if ($levels_percent + $request->percent > 100) {
            return redirect()->back()->with('error', 'اجمالى نسب المراحل اكبر من 100 ');
        }

        Level::create($data);
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
        $permission = Level::findOrFail($id);
        return view('admin.setting.Level.edit', compact('permission'));

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
            'contract_id' => 'required|exists:contract,id',
            'type' => 'required|in:1,2,3',
            'sort' => 'required|numeric',
            'progress_time' => 'required|numeric',
        ]);
        $level_percents = Level::where('contract_id', $request->contract_id)->sum('percent');
        $level = Level::whereId($request->id)->first();
        if ($level_percents + $request->percent - $level->percent > 100) {
            return redirect()->back()->with('error', 'اجمالى نسب المراحل اكبر من 100 ');
        }
        $user = Level::whereId($request->id)->update($data);
        return redirect(url('level-setting/' . $request->contract_id))->with('message', 'تم التعديل بنجاح ');

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
            Level::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}
