<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softdeletes;

class course extends Model
{
    use softdeletes;

    protected $with = ['lessons'];
   

   protected $fillable = [
   
];


public function lessons(){
    return $this->HasMany(lesson::class);
 }



 public function user()
 {
     return $this->belongsTo(User::class);
 }


 public function comments()
 {
     return $this->HasMany(review::class,'course_id');
 }

 public function certificate(){
    return $this->HasMany(result::class,'course_id');
 }

}
