<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject' ,	'RoleAccess',
    ];
    public function ticket(){
        return $this->belongsTo('App\ticket');
    }
}
