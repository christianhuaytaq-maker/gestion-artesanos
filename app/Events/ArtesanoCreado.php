<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArtesanoActualizado implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $usuario;

    public function __construct(string $usuario = 'Usuario')
    {
        $this->usuario = $usuario;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('artesanos');
    }

    public function broadcastAs(): string
    {
        return 'ArtesanoActualizado';
    }
}