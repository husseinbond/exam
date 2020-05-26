<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softdeletes;
class lesson extends Model
{
    use softdeletes;
    protected $fillable = [
   
    ];

    public function courses(){
        return $this->belongsTo(course::class,'course_id');
    }


    public function video(){
        return $this->HasMany(video::class,'lesson_id');
    }

    



    

}
