<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ticket;
use App\Subject;
use App\TicketBody;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
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
        $staffs = DB::table('users')->where('role', '<', $user->role)->get();
        $subject = Subject::where('RoleAccess' , $user->role)->get();
//        $ticket = ticket::where('receiver_id', $user->id)->where('status', 0)->get();
        $ticket = ticket::where('receiver_id',$user->id)->orWhere('sender_id', $user->id)->get();
        return view('ticket.index', compact('TicketBody', 'ticket', 'staffs', 'subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()
    {

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
        $staffs = DB::table('users')->where('role', '<', $user->role)->get();
        $subjects = Subject::where('RoleAccess' , $user->role)->get();
        $ticket = ticket::where('sender_id' , $user->id)->orwhere('receiver_id' , $user->id)->orderBy('created_at' , 'ASC')->orderBy('status' , 'DESC')->get();
        $Subject = Subject::create([
            'subject' => $request->subject,
            'RoleAccess' => $request->receiver_id
        ]);
        $ticketCreated = ticket::create([
            'sender_id' => $user->id,
            'receiver_id' => $Subject->RoleAccess,
            'subject_id' => $Subject->id,
            'body'=> $request->body,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => null
        ]);

        return view('ticket.index' , compact('ticketCreated' , 'Subject', 'subjects' , 'TicketBody', 'ticket', 'staffs', 'subject' , 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function answer($subject_id)
    {
        $user = Auth::user();
        if(!empty(Subject::where('id' , $subject_id)->first())){
            $subject = Subject::where('id' , $subject_id)->first();
            $tickets = ticket::where('subject_id' , $subject->id)->where('sender_id' , $user->id)->orwhere('receiver_id' , $user->id)->orderBy('created_at' , 'ASC')->get();
            ticket::where('subject_id' , $subject_id)->where('receiver_id' , $user->id)->update(['status' => 1]);
            return view('ticket.answer' , compact('user' ,'tickets' ,  'subject' , 'subject_id'));
        }
        else{
            $subject = "<span class='text-danger'>".'این تیکت وجود ندارد'."</span>";
            return view('ticket.answer' , compact('user' ,'tickets' ,  'subject' , 'subject_id'));
        }
    }
    public function answers(Request $request){
        $user = Auth::user();
        ticket::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'subject_id' => $request->subject_id,
            'body'=> $request->body,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => null
        ]);
        return back();
    }
}
