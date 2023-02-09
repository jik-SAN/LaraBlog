<?php

namespace App\Events;

use App\Models\Post;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewPostCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user, $post;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($post, $user)
    {
        $this->user = $user;
        $this->post = $post;
    }

}
