<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Grupo extends Model
{
	protected $fillable = [
        'nombre'
    ];
    protected  $table = 'grupos';
    
    public function users(){
    	return $this->belongsToMany(User::class,'assigned_grupos');
    }
    public function notas(){
    	return $this->hasMany(nota::class);
    }
    
}
