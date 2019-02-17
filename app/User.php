<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        //relacion muchos a muchos belongsToMany
        return $this->belongsTo(Role::class);
    }
    public function hasRole(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->role->name === $role) {
                 return  true;
            }
        }
         return false;
       
    }
    public function proyectos(){
        return $this->hasMany(Proyecto::class);
    }
     public function notas(){
        return $this->hasMany(nota::class);
    }
    public function grupos(){
        return $this->belongsToMany(Grupo::class,'assigned_grupos');
    }
    public function misnotas(){
        return$this->belongsToMany(nota::class,'assigned_notas');
    }
}
