<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArtesanoCreado implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nuevoTotal;
    public $nombreArtesano;
    public $especialidad;

    // Recibimos los datos que queremos mostrar en la TV
    public function __construct($nuevoTotal, $nombreArtesano, $especialidad)
    {
        $this->nuevoTotal = $nuevoTotal;
        $this->nombreArtesano = $nombreArtesano;
        $this->especialidad = $especialidad;
    }

    public function broadcastOn(): array
    {
        return [new Channel('panel')];
    }
}
