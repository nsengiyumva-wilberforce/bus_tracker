<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'bookings';

    public function route()
{
    return $this->belongsTo(Route::class);
}

public function bus()
{
    return $this->belongsTo(Bus::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
