<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //por si el nombre de la tabla no es igual al del modelo se agrega la propiedad 
    //protected $table = 'nombre de la tabla';
    //eso es para habilitar los datos que se van a subir o  modificar, es por seguridad
    protected $fillable = ['nombre','descripcion'];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
