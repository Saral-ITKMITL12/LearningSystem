<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
     protected $fillable = ['course_id', 'user_id', 'descript'];

     public function getImageAttribute($value)
         {
             if ($value != null) {
                 $path = preg_split("/\./", $value);
                 $mime_type = end($path);
                 return "data:image/$mime_type;base64," . base64_encode(\Storage::get($value));
             }
         }
}
