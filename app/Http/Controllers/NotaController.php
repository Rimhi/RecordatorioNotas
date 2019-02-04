<?php

namespace App\Http\Controllers;

use DB;
use App\nota;
use App\Categoria;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

class NotaController extends Controller
{




    public function __construc(){

         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $notas = nota::paginate();
        return view('notas/index')->with(compact(['notas','id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $usuarios = User::all();
        return view('notas.add',compact('nota','usuarios','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        DB::table('notas')->insert([
        "user_id"=>auth()->user()->id,
        "colaborador"=>$request->input('colaborador'),
        "name" => $request->input('name'),
        "descripcion" => $request->input('descripcion'),
        "fecha_final" => $request->input('fecha_final'),
        "estado_id" =>$request->input('estado'),
        'categoria_id'=>$request->input('categoria'),
        "created_at" => Carbon::now(),
        "updated_at" => Carbon::now(), 
        ]);
        /*
        $nota = nota::create($request->all());
         if (auth()->check()) {
             auth()->user()->notas()->save($nota);
         }*/

        return  redirect()->route('nota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(nota $nota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit(nota $nota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, nota $nota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(nota $nota)
    {
        //
    }
}
