<?php 
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class BusLocationUpdated implements ShouldBroadcast
{
    use Dispatchable;

    public $busId;
    public $latitude;
    public $longitude;
    public $timestamp;
    public $speed;
    public $direction;

    public function __construct($data)
    {
        $this->busId = $data['bus_id'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->timestamp = $data['timestamp'];
        $this->speed = $data['speed'];
        $this->direction = $data['direction'];
    }

    public function broadcastOn(): Channel
    {
        return new Channel('bus-locations');
    }
}