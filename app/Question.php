<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function getImageAttribute($value)
        {
            if ($value != null) {
                $path = preg_split("/\./", $value);
                $mime_type = end($path);
                return "data:image/$mime_type;base64," . base64_encode(\Storage::get($value));
            }
        }

}
