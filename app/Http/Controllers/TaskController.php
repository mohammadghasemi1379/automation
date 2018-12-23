<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $task = task::where('user_id', Auth::id())->latest()->first();
        if (isset($task->created_at)){
            $last_entered_time = $task->created_at;
            $diff = Carbon::now()->diffInDays($last_entered_time);
            if ($diff > 0){
                $entered = 'شما امروز وارد نشده اید';
            }
            else{
                $entered = $task->created_at;
            }
        }else{
            $entered = 'شما تا الان ثبت ورود نکرده اید.';
        }
        if (empty($task->updated_at)){
            $exited = 'شما هنوز خارج نشده اید.';
        }else{
            $exited = $task->updated_at;
        }
        $staffs =  DB::table('users')->where('role', '<', $user->role)->get();;
        return view('task' , compact('exited' , 'entered' , 'staffs'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function enter()
    {
        $user = Auth::user();
        $tasks = task::where('user_id', Auth::id())->latest()->first();
        if (isset($tasks->created_at)) {
            $last_entered_time = $tasks->created_at;
            $diff = Carbon::now()->diffInDays($last_entered_time);
        }else{
            $diff = 1;
        }
        if ($diff > 0) {
            task::create([
                'user_id' => $user->id,
                'updated_at' => null,
            ]);
            return back();
        } else {
            return redirect()->back()->with('status', 'شما امروز وارد شده اید');
        }

}
    public function exit()
    {
        $tasks = task::where('user_id', Auth::id())->latest()->first();
        if (isset($tasks->created_at)) {
            if ($tasks->updated_at != null) {
                $last_entered_time = $tasks->created_at;
                $diff = Carbon::now()->diffInDays($last_entered_time);
            }else{
                $diff = 1;
            }
        }
        if ($diff > 0) {
            DB::table('tasks')->where('created_at', $tasks->created_at)->latest()->update(['updated_at' => now()]);
            return back();
        }else{
            return redirect()->back()->with('statuses', 'شما امروز یک بار خارج شده اید');
        }
    }
    public function staff($id){
        $tasks = DB::table('tasks')->where('user_id' , $id)->paginate(5);
        return view('staff' , compact('tasks' , 'id'));
    }
}
