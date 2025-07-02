<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use React\EventLoop\Loop;
use FlyService;
use React\ChildProcess\Process;
use Laravel\Reverb\ApplicationManager;
use Laravel\Reverb\Protocols\Pusher\EventDispatcher;

use Laravel\Reverb\Servers\Reverb\Factory as ReverbServerFactory; // Correct namespace
use React\Datagram\Factory as DatagramFactory;  // Add this import
use React\Datagram\Socket;                     // Correct namespace

class MovementCommand extends Command
{
    const FLY_COMMAND_IP = '127.0.0.1'; // Replace with actual IP
    const FLY_COMMAND_PORT = 9001;      // Replace with actual port
    const FLY_STATE_IP = '127.0.0.1';   // Replace with actual IP
    const FLY_STATE_PORT = 9002;        // Replace with actual port
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:movement-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to receive geolocation cooridinates from arduino and send them to the frontend';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loop = Loop::get();

        [
            'server' => $server,
            'host' => $host,
            'port' => $port,
        ] = $this->createWebSocketServer($loop, config('reverb.servers.reverb'));

        $this->fly($loop);

        $this->status($loop);

        $this->display($loop);
    }

    protected function createWebSocketServer($loop, $config)
    {
        $factory = new ReverbServerFactory(); // Create instance

        $host = $this->option('host') ?: $config['host'];
        $port = $this->option('port') ?: $config['port'];
        $hostname = $this->option('hostname') ?: $config['hostname'];

        $server = $factory->make(
            $host,
            $port,
            $hostname,
            $config['max_request_size'] ?? 10_000,
            $config['options'] ?? [],
            $loop
        );
        
    }

    /**
     * 
     * *Create a UDP  client on the event loop.
     * 
     * */

    protected function fly($loop): void
    {
        // Implementation for the fly method
        (new DatagramFactory($loop))->createClient(self::FLY_COMMAND_IP . ':' . self::FLY_COMMAND_PORT)
            ->then(function (Socket $socket) {

                $this->laravel->singleton(FlyService::class, fn() => new FlyService($socket));
            });
    }

    protected function status($loop): void
    {
        // Implementation for the status method
        (new DatagramFactory($loop))->createServer(self::FLY_STATE_IP . ':' . self::FLY_STATE_PORT)
            ->then(function (Socket $server) {

                $server->on('message', function ($state) {
                    EventDispatcher::dispatch(
                        $this->laravel->make(ApplicationManager::class)->all()->first(),
                        [
                            'event' => 'App\\Events\\StateChanged',
                            'channel' => 'private-fly',
                            'data' => FlyService::parseState($state)
                        ]
                    );
                });
            });
    }

    protected function display($loop): void
    {
        $process = new Process($this->generateFfmpegCommand());

        $process->start($loop);

        $process->stdout->on('data', function ($chunk) {
            EventDispatcher::dispatch(
                $this->laravel->make(ApplicationManager::class)->all()->first(),
                [
                    'event' => 'App\\Events\\VideoStreamed',
                    'channel' => 'private-fly',
                    'data' => base64_encode($chunk)
                ]
            );
        });
    }

    protected function generateFfmpegCommand(): string
    {
        return 'ffmpeg -f x11grab -framerate 30 -video_size 1920x1080 -i :0.0 -f mpegts udp://';
    }
}
