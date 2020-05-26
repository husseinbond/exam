<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softdeletes;
class video extends Model
{

    use softdeletes;

    public function lessons(){
        return $this->belongsTo(lesson::class);
     }
    
}
