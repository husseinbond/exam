<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $with = ['user'];

    public function course()
    {
        return $this->belongsTo(course::class,'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $hidden = [
        'user_id'
    ];



    

}
