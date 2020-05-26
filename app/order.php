<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
   
 

    public function course(){
        return $this->belongsTo(course::class,'course_id');
    }


}
