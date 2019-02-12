<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\User;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class GrupoController extends Controller
{
   


    public function __construc(){
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuarios = User::pluck('name','id');
        $grupos = Grupo::all();
        return view('grupos.index')->with(compact(['grupos','usuarios']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $grupo = Grupo::create($request->all());
        $grupo->users()->sync($request->user_id);
         /*
         if (auth()->check()) {
             auth()->user()->grupos()->save($grupo);
         }*/
          return  redirect()->route('nota.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        //
    }
}
