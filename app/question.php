<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softdeletes;
class question extends Model
{
    use softdeletes;



    public function answer(){
        return $this->HasMany(answer::class);
     }
    
    
}
