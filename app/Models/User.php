<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['username', 'email', 'phone_number', 'password', 'first_name', 'last_name', 'profile_picture', 'preferences'];
    protected $casts = ['preferences' => 'array'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function routePreferences()
    {
        return $this->hasMany(UserRoutePreferences::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_picture
            ? asset('storage/' . $this->profile_picture)
            : asset('assets/img/default-avatar.jfif');
    }
}
