<?php

namespace App\Http\Controllers;

use DB;
use App\Proyecto;
use Carbon\Carbon;
use Illuminate\Http\Request;


class registro extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(){
        $this->middleware('auth',['except'=>['create','store']]);
    }
    public function index()
    {
       // hay dos formas de hacerlo, la comentada es por sentiencias de consultas y la no comentada es por eloquent
        //$proyecto = DB::table('proyeto')->get();
        $id = auth()->user()->id;
        $proyecto = Proyecto::paginate();
        return view('registrar/index')->with(compact(['proyecto','id']));
        
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('registro',compact('registro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // formas de guardar datos
        //numero 1 por consultas
        
        //dd($request);
        DB::table('proyectos')->insert([
        "user_id"=>auth()->user()->id,
        "nombre"=>$request->input('nombre'),
        "descripcion"=>$request->input('descripcion'),
        "created_at" => Carbon::now(),
        "updated_at" => Carbon::now(), 
        ]);
        
        //numero 2 elquent
        /*
        $proyecto = new Proyecto;
        $proyecto-> nombre = $request->input('nombre');
        $proyecto-> descripcion = $request->input('descripcion');
        $proyecto->save();
        // las fechas no se guardan por que en eloquent se guardan por defecto 
        */
        //y asi susesivamente
        //forma numero 3
        /*
        $proyecto = Proyecto::create($request->all());
         if (auth()->check()) {
             auth()->user()->proyectos()->save($proyecto);
         }*/

        return  redirect()->route('registro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        //$proyecto = DB::table('proyeto')->where('id',$id)->first();
        $proyecto = Proyecto::findorFail($id);
        return view('registrar.show')->with(compact('proyecto'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // $proyecto = DB::table('proyeto')->where('id',$id)->first();
        $proyecto = Proyecto::findorFail($id);
        return view('registrar.edit')->with(compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        /**
        DB::table('proyeto')->where('id',$id)->update([
        "nombre" => $request->input('nombre'),
        "descripcion" => $request->input('descripcion'),
        "updated_at" => Carbon::now(), ]);
         $proyecto = Proyecto::findorFail($id);**/
         //return  redirect()->route('registro.index');
         if ($request->ajax()) {
             # code...
            $proyecto = Proyecto::findorFail($id);
            $proyecto->update($request->all());
            $proyectoTotal = Proyecto::all()->count();
         }
       return response()->json([
            'total'=>$proyectoTotal,
            'mensaje' => $proyecto->name.' se ha editado con exito'

       ]);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //DB::table('proyeto')->where('id',$id)->delete();
        //return  redirect()->route('registro.index');
       if ($request->ajax()) {
            $proyecto = Proyecto::findorFail($id);
            $proyecto->delete();
            $proyectoTotal = Proyecto::all()->count();

        }

       return response()->json([
            'total'=>$proyectoTotal,
            'mensaje' => $proyecto->name.' se ha eliminado con exito'

       ]);
        
    }
}
