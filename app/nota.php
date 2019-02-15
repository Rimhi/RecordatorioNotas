<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nota extends Model
{
       protected $fillable = ['name','descripcion','user_id','fecha_final','estado_id','categoria_id','grupo_id'];
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
    public function estado(){
        return $this->belongsTo(Estado::class);
    }
    public function grupo(){
        return $this->belongsTo(Grupo::class);
    }


    //scope
    public function scopeName($query, $name)
    {
    	if ($name) {
    		return $query->where('name','LIKE',"%$name%");
    	}
    }
     public function users(){
        return $this->belongsToMany(User::class,'assigned_notas');
    }
}

