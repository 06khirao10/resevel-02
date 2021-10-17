<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id','requirements','start_datetime','end_datetime'];

    public function user()
    {
        return $this->belongsTo('App\User');

    }
    public $timestamps = false;
}
