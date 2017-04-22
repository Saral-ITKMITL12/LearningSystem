<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
     protected $fillable = ['course_id', 'user_id', 'descript'];
}
