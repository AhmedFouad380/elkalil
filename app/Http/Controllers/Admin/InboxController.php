<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inboxes = inbox::where(function ($query) {
            $query->where('recipient_id', Auth::id())->orWhere('sender_id', Auth::id());
        })->where(function ($query) {
            $query->where('empl', 0)->orWhere('empl', 2);
        })->where('sub', 0)->orderBy('id','desc')->paginate(10);
        return view('admin.inbox.inbox', compact('inboxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inbox = inbox::with(['replies', 'files'])->where('id',$id)->firstOrFail();
        if (Auth::id() == $inbox->recipient_id) {
            $inbox->view=1;
            $inbox->save();
        }
        $inbox_replies = inbox::where('sub',$id)->update([
            'view'=>1
        ]);
        return view('admin.inbox.reply', compact('inbox'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
