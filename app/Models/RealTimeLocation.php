<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealTimeLocation extends Model
{
    protected $fillable = ['bus_id', 'latitude', 'longitude', 'timestamp', 'speed', 'direction'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
