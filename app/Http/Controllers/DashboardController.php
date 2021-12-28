<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Events;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Auth;
class DashboardController extends Controller
{
    public function index(Request $request){
        if(Auth::Check()){
            if(isset($request->id)){
            $contract = Contract::find($request->id);
                }else{
                $contract = Contract::where('id','!=',1)->first();
            }
        return view('admin/dashboard',compact('contract'));
        }else{
            return redirect('/login');
        }
    }

    public function store_event(Request $request){

        $data = new Events();
        $data->user_id=Auth::user()->id;
        $data->title=$request->title;
        $data->date=$request->date;
        $data->time=$request->time;
        $data->description=$request->description;
        $data->save();

        return redirect('/')->with('message','Success');
=======
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        return view('admin/dashboard');
>>>>>>> 23927eb76fc7999f4b12fae7194804a5c0a10368

    }
}
