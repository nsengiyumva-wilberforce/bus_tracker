<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = ['bus_number', 'capacity', 'route_id', 'status'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function realTimeLocations()
    {
        return $this->hasMany(RealTimeLocation::class);
    }

    public function bookings()
    {
        return $this->hasMany(Book::class);
    }
}
