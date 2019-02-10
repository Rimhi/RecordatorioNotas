<?php

namespace App\Http\Controllers;

use DB;
use App\nota;
use App\Categoria;
use App\Estado;
use App\Grupo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use App\Http\Controllers\Auth;
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
    public function index(Request $request)
    {
     
           
        $name = $request->get('name');
         if (auth()->user()!=null) {
            $id = auth()->user()->id;
        }   

            
            $notas = nota::orderBy('id')
            ->name($name)
            ->with(['user'])
            ->get();
        return view('notas/index')->with(compact(['notas','id']));
    }
    /**
    Estados: Pendiente,Terminado,advertencia,urgente <---realizado el agregar estados

    Crear grupos

    dashboard

    fecha inicio y final <--- agregada


    categorias:  <----completo


    sistema de alertas por dias -3, -5 y -7 dias de 3 hacia abajo todos los dias un correo
    **/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = Grupo::pluck('nombre','id');
        $categorias = Categoria::all();
        $estados = Estado::all();
        $user = auth()->user();
        return view('notas.add',compact('estados','nota','user','categorias','grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $nota = DB::table('notas')->insert([
        "user_id"=>auth()->user()->id,
        "colaborador"=>$request->input('colaborador'),
        "name" => $request->input('name'),
        "descripcion" => $request->input('descripcion'),
        "fecha_final" => $request->input('fecha_final'),
        "estado_id" =>$request->input('estado'),
        'categoria_id'=>$request->input('categoria'),
        "created_at" => $request->input('fecha_inicio'),
        "updated_at" => Carbon::now(), 
        ]);
        Mail::send('emails.addNota',['nota'=>$nota],function($mensaje) use ($nota){
                  $mensaje->to(auth()->user()->email, auth()->user()->name)->subject('haz creado una nota!'); 
        });
        /*
        $nota = nota::create($request->all());
         if (auth()->check()) {
             auth()->user()->notas()->save($nota);
         }*/
         
       // return  redirect()->route('nota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $nota = nota::findorFail($id);
        $grupo = Grupo::findorFail($nota->colaborador);
        return view('notas.show')->with(compact(['nota','grupo']));
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
        return view('notas.edit')->with(compact('nota','usuarios','categorias'));
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
         
        DB::table('notas')->where('id',$id)->update([
        "colaborador"=>$request->input('colaborador'),
                "name" => $request->input('name'),
                "descripcion" => $request->input('descripcion'),
                "fecha_final" => $request->input('fecha_final'),
                "estado_id" =>$request->input('estado'),
                "categoria_id"=>$request->input('categoria'),
                "updated_at" => Carbon::now(), ]);
         $nota = nota::findorFail($id);
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

        
        DB::table('notas')->where('id',$id)->delete();
        return  redirect()->route('nota.index');
        
    }
}
