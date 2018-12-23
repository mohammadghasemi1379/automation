<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    protected $fillable = [
        'sender_id', 'subject_id' , 'receiver_id', 'body', 'role' , 'conversation_id' , 'created_at' , 'updated_at',
    ];
    public function subject(){
        return $this->hasMany('App\Subject');
    }
    public function TicketBody(){
        return $this->hasMany('App\TicketBody');
    }
}
