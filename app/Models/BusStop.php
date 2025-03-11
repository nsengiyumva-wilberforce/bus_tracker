<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusStop extends Model
{
    protected $fillable = ['name', 'location', 'latitude', 'longitude'];

    public function startingRoutes()
    {
        return $this->hasMany(Route::class, 'starting_station_id');
    }

    public function endingRoutes()
    {
        return $this->hasMany(Route::class, 'ending_station_id');
    }
}
