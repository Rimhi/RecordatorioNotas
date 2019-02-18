<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
	protected $fillable = ['comentario','nota_id','user_id'];
    public function nota(){
    	return $this->belongsTo(nota::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
