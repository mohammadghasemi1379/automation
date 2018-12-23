<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks_recieve= Todo::where('receiver_id' , Auth::user()->id)->paginate(5);
        $tasks_send = Todo::where('sender_id' , Auth::user()->id)->paginate(5);
        $staffs = DB::table('users')->where('role', '<', Auth::user()->role)->get();
        return view('TaskManager' , compact('tasks_recieve', 'tasks_send' ,'staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        Todo::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'body'=> $request->body,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => null
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
    public function done(Request $request)
    {
        Todo::where('id' , $request->taskDone)->update(['status' => 1]);
    }
}
