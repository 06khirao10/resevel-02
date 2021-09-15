<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
    protected $fillable = ['name','password','e-mail'];
}
