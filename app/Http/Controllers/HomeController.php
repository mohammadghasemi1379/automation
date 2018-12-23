<?php

namespace App\Http\Controllers;

use App\User;
use App\task;
use http\Env\Response;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Tags;
use Verta;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
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
//        $Times = task::where('user_id', Auth::id())->first();
//        foreach($Times->created_at as $enter){
//            foreach($Times->updated_at as $exit) {
//                Carbon::createFromFormat('H:i:s', $exit);
//                Carbon::createFromFormat('H:i:s', $enter);
//               $sum = $enter+$exit;
//               return $sum;
//            }
//        }
        $MyRole = $user->role;
        $staffs = DB::table('users')->where('role', '<', $MyRole)->get();
        return view('home' , compact( 'user' , 'exited' , 'entered' , 'task' , 'staffs'));
    }
}
