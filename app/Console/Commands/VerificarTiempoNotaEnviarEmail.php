<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\nota;
use Carbon\Carbon;
use Mail;

class VerificarTiempoNotaEnviarEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviaremail:notas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'este comando verifica el tiempo de vida de la nota y envia un email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notas = nota::all();
        $date = Carbon::now()->format('Y-m-d');
        $now = Carbon::parse($date);
        if ($notas) {
            foreach ($notas as $nota) {
               // dd($nota->responsable);
                if ($now->diffInDays($nota->fecha_final,false) == 7) {
                    Mail::send('emails.addNota',['nota'=>$nota],function($mensaje) use ($nota){
                        $mensaje->to($nota->user->email, $nota->user->name)->subject('7 dias'); 
                    });
                }else if($now->diffInDays($nota->fecha_final,false) == 5){
                    Mail::send('emails.addNota',['nota'=>$nota],function($mensaje) use ($nota){
                      $mensaje->to($nota->user->email, $nota->user->name)->subject('5 dias'); 
                    });
                 
                }else if($now->diffInDays($nota->fecha_final,false) == 3){
                    Mail::send('emails.addNota',['nota'=>$nota],function($mensaje) use ($nota){
                      $mensaje->to($nota->user->email, $nota->user->name)->subject('3 dias'); 
                    });

                }else if($now->diffInDays($nota->fecha_final,false) == 2){
                    Mail::send('emails.addNota',['nota'=>$nota],function($mensaje) use ($nota){
                      $mensaje->to($nota->user->email, $nota->user->name)->subject('2 dias!'); 
                    });

                }else if ($now->diffInDays($nota->fecha_final,false) == 1) {
                    Mail::send('emails.addNota',['nota'=>$nota],function($mensaje) use ($nota){
                      $mensaje->to($nota->user->email, $nota->user->name)->subject('1 dia!'); 
                    });
                 
                }
            }
        }


    }
}
