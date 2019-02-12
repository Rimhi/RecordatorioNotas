<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nota extends Model
{
       protected $fillable = ['nombre','descripcion'];
       protected $dates = ['fecha_final'];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function categoria(){
    	return $this->belongsTo(Categoria::class);
    }
    public function comentarios(){
        return $this->hasOne(Comenterio::class);
    }


    //scope
    public function scopeName($query, $name)
    {
    	if ($name) {
    		return $query->where('name','LIKE',"%$name%");
    	}
    }
}

