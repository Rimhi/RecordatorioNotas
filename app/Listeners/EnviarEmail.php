<?php

namespace App\Listeners;

use App\Events\NotaCreada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use SuperClosure\Serializer;
class EnviarEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotaCreada  $event
     * @return void
     */
    public function handle(NotaCreada $event)
    {
        
        $nota = $event->nota;
        //dd($event->nota);
        Mail::send('emails.addNota',['nota'=>$nota],function($mensaje) use ($nota){
                  $mensaje->to(auth()->user()->email, auth()->user()->name)->subject('haz creado una nota!'); 
        });
        
    }
}
