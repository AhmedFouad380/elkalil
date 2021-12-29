<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Explan;
use Illuminate\Http\Request;
use Auth;
class ExplanController extends Controller
{
    public function Add_explan(Request $request){
        Explan::create([
            'title' => $request->title,
            'comments' => $request->comments,
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time' => \Carbon\Carbon::now()->format('H:i:s'),
            'emp_name'=>Auth::user()->name,
            'emp_id'=>Auth::user()->id,
            'project_id'=>$request->project_id
        ]);
        return back()->with('message','Success');
    }
}
