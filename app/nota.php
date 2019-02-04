<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nota extends Model
{
       protected $fillable = ['nombre','descripcion'];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
