<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Grupo extends Model
{
	protected $fillable = [
        'nombre'
    ];
    
    public function users(){
    	return $this->belongsToMany(User::class,'assigned_grupos');
    }
}
