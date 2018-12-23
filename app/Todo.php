<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'body', 'status' , 'created_at' , 'updated_at',
    ];
}
