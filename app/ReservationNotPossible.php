<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationNotPossible extends Model
{
    protected $fillable = ['date'];

    public $timestamps = false;

}
