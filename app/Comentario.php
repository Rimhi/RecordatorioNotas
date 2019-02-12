<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
	protected $fillable = ['comentario']
    public function nota(){
    	return $this->belongsTo(nota::class);
    }
}
