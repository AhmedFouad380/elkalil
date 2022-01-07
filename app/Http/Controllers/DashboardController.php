<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Events;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (Auth::Check()) {
            if (isset($request->id)) {
                $contract = Contract::find($request->id);
            } else {
                $contract = Contract::where('id', '!=', 1)->first();
            }
            return view('admin/dashboard', compact('contract'));
        } else {
            return redirect('/login');
        }
    }

    public function projectState(Request $request)
    {
        $from = $request->project_from;
        $to = $request->project_to;
        return view('admin.dashboardprojectStateModal', compact('from', 'to'));
    }

    public function store_event(Request $request)
    {

        $data = new Events();
        $data->user_id = Auth::user()->id;
        $data->title = $request->title;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->description = $request->description;
        $data->save();

        return redirect('/')->with('message', 'Success');

    }
}
