<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;

class PreCreateNota extends Controller
{
    public function index(){
    	 $grupos = Grupo::pluck('nombre','id');
    	 $user = auth()->user();
    	 return view('precreatenota.index',compact('grupos','user'));
    }
    public function enviar(Request $request){
    	//dd($request);
    	return redirect()->route('nota.create',$request->colaborador);


    }
}
