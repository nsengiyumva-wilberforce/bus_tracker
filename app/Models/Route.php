<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['name', 'starting_station_id', 'ending_station_id', 'timetable'];
    protected $casts = ['timetable' => 'array'];

    public function startingStation()
    {
        return $this->belongsTo(BusStop::class, 'starting_station_id');
    }

    public function endingStation()
    {
        return $this->belongsTo(BusStop::class, 'ending_station_id');
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
