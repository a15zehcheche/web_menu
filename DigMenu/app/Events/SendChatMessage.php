<?php

namespace App\Events;

use Illuminate\Console\Command;

class SendChatMessage extends Command
{
    /**
     * Create a new event instance.
     *
     * @param PHPSocketIO\SocketIO $server
     * @return void
     */
    public function __construct($io)
    {
		$this->io =$io;
        		
		$io->on('connection', function ($socket) use ($io) {
			//向所有客户端发送事件
			$socket->on('chat message', function ($msg) use ($io) {
				$io->emit('chat message', 'public: '.$msg);
			});

			$socket->on('orderzehao', function ($msg) use ($io) {
				$io->emit('orderzehao', 'order: '.$msg);
			});
			$socket->on('ordertree', function ($msg) use ($io) {
				$io->emit('ordertree', 'order: '.$msg);
			});

			//向当前客户端发送事件
			$socket->on('chat message private', function ($msg) use ($socket) {
				$socket->emit('chat message', 'private: '. $msg);
			});
		});
	}
	public function emit()
	{
		$this->io->emit('chat message', 'public: '.'test');
	}

}