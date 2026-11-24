<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificacionUsuarioEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ?int $userId;
    public string $titulo;
    public string $mensaje;
    public string $tipo;

    public function __construct(?int $userId, string $titulo, string $mensaje, string $tipo = 'info')
    {
        $this->userId = $userId;
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->tipo = $tipo;
    }

    public function broadcastOn(): array
    {
        $channels = [
            new Channel('tienda-artesanos'),
        ];

        if ($this->userId) {
            $channels[] = new PrivateChannel('App.Models.User.' . $this->userId);
        }

        return $channels;
    }

    public function broadcastAs(): string
    {
        return 'notificacion.usuario';
    }
}
