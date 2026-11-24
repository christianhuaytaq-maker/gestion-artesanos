<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompraRealizada implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nombreCliente;
    public $nombreProducto;
    public $precio;

    public function __construct($nombreCliente, $nombreProducto, $precio)
    {
        $this->nombreCliente = $nombreCliente;
        $this->nombreProducto = $nombreProducto;
        $this->precio = $precio;
    }

    public function broadcastOn()
    {
        return new Channel('panel');
    }
}
