<?php

namespace App\Http\Controllers;

use DB;
use App\nota;
use App\Categoria;
use App\Estado;
use App\Grupo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Auth;
use App\User;
use App\Events\NotaCreada;

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
    public function index(Request $request)
    {
    // dd(Carbon::now()->format('d-m-y'));
           
        $name = $request->get('name');
         if (auth()->user()!=null) {
            $id = auth()->user()->id;
        }   
        $date = Carbon::now()->format('Y-m-d');
        $now = Carbon::parse($date);
            $notas = nota::orderBy('id')
            ->name($name)
            ->with(['user'])
            ->get();
        return view('notas/index')->with(compact(['notas','id','now']));
    }
    /**
    Estados: Pendiente,Terminado,advertencia,urgente <---realizado el agregar estados

    Crear grupos <----finalizado

    dashboard

    fecha inicio y final <--- agregada


    categorias:  <----completo


    sistema de alertas por dias -3, -5 y -7 dias de 3 hacia abajo todos los dias un correo





    correciones: Responsable -> en el responsable yo lo pedo elegir de los integrantes del grupo
    antes mostrar el grupo al que se le va asignar la nota y de ahi aparecera la lista de integrantes para poseteriormente elegir los colaboradores, responsive, mejorar diseño
    **/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
            $grupo = Grupo::findorFail($request->id);
            $id = $request->id;
            $categorias = Categoria::all();
            $estados = Estado::all();
        
        return view('notas.add',compact('estados','categorias','grupo','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $nota = nota::create($request->all());
       /* 
        $nota = DB::table('notas')->insert([
        "user_id"=>$request->input('user_id'),
        "grupo_id"=>$request->input('grupo_id'),
        "name" => $request->input('name'),
        "descripcion" => $request->input('descripcion'),
        "fecha_final" => $request->input('fecha_final'),
        "estado_id" =>$request->input('estado_id'),
        'categoria_id'=>$request->input('categoria_id'),
        "created_at" => $request->input('created_at'),
        "updated_at" => Carbon::now(), 
        ]);*/
        $nota->users()->sync($request->colaborador);

        //event(new NotaCreada($request));
       
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
    public function show($id)
    {
        $nota = nota::findorFail($id);
        return view('notas.show')->with(compact(['nota']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nota = nota::findorFail($id);
        $categorias = Categoria::all();
        $usuarios = User::all();
        $estados = Estado::all();
        return view('notas.edit')->with(compact('nota','usuarios','categorias','estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* 
        DB::table('notas')->where('id',$id)->update([
        "grupo_id"=>$request->input('colaborador'),
                "name" => $request->input('name'),
                "descripcion" => $request->input('descripcion'),
                "fecha_final" => $request->input('fecha_final'),
                "estado_id" =>$request->input('estado'),
                "categoria_id"=>$request->input('categoria'),
                "updated_at" => Carbon::now(), ]);
                */
         $nota = nota::findorFail($id);
         $nota->update($request->all());
         $nota->users()->sync($request->colaborador);
         return  redirect()->route('nota.index');
            /**
            dd($request->fecha_final);
            $nota->update([
                "colaborador"=>$request->input('colaborador'),
                "name" => $request->input('name'),
                "descripcion" => $request->input('descripcion'),
                "fecha_final" => $request->input('fecha_final'),
                "estado_id" =>$request->input('estado'),
                "categoria_id"=>$request->input('categoria'),
                "updated_at" => Carbon::now(),
            ]);
            //dd($request);
            $notaTotal = nota::all()->count();

            return redirect()->route('nota.index');
            **/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nota = nota::findorFail($id);
        //$nota = nota::where('id','=',$id);
        $nota->users()->detach();
        DB::table('notas')->where('id',$id)->delete();
        return  redirect()->route('nota.index');
        
    }
}
