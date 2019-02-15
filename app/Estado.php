<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public function notas(){
        return $this->hasMany(nota::class);
    }
}
