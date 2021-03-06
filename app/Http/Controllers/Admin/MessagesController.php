<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PercentCategory;
use App\Models\Setting;
use App\Models\SmsLogs;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MessagesController extends Controller
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
        $settings = Setting::findOrFail(1);
        return view('admin.setting.messages.index', compact('settings'));
    }

    public function datatable(Request $request)
    {
        $data = SmsLogs::orderBy('id', 'desc');

        $data = $data->get();
        return Datatables::of($data)
            ->editColumn('description', function ($row) {
                $name = ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->description . '</span>';
                return $name;
            })
            ->rawColumns(['description'])
            ->make();

    }


}
