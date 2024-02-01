<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userNotification;
    
    /**
     * Create a new event instance.
     */
    public function __construct(Message $message, int $userNotification)
    {
        $this->message = $message;
        $this->userNotification = $userNotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    //cria o canal
    public function broadcastOn(): array
    {
        //canal de mensagem entre cada usuario
        //cada conversa vai ter um canal identificado pelo usuario receptor
        return [
            new PrivateChannel('user.'.$this->userNotification),
        ];
    }
    
    //retorna o metodo disparado pelo evento
    public function broadcastAs()
    {
        return 'SendMessage';
    }
    
    //retorna o conteudo para o metodo que foi disparado
    //retorna o conteudo da mensagem disparada pelo metodo SendMessage
    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }
    
}
