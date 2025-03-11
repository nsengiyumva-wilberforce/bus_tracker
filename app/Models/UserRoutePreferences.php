<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoutePreferences extends Model
{
    protected $fillable = ['user_id', 'route_id', 'preferred_stops', 'notification_enabled'];
    protected $casts = ['preferred_stops' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
