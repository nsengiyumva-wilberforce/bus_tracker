<?php
use React\Datagram\Socket;

class FlyService
{
   public function __construct(protected Socket $socket)
   {
    $socket->send('command');
   }

   public function send(string $command): void
   {
       $this->socket->send($command);
   }

       public static function parseState(string $state): array
    {
        // Example parsing logic - customize for your drone's protocol
        return [
            'timestamp' => now()->toDateTimeString(),
            'data' => trim($state),
            'battery' => 100, // Extract actual value from $state
            'gps' => [
                'lat' => 0.0, // Extract actual values
                'lng' => 0.0,
            ],
        ];
    }

}