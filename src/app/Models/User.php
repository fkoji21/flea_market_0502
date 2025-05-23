<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // リレーション
    public function items()
    {return $this->hasMany(Item::class);}
    public function addresses()
    {return $this->hasMany(Address::class);}
    public function purchases()
    {return $this->hasMany(Purchase::class);}
    public function comments()
    {return $this->hasMany(Comment::class);}
    public function address()
    {return $this->hasOne(Address::class);}
    public function likes()
    {return $this->belongsToMany(Item::class, 'likes');}

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $path = storage_path('app/public/' . $this->profile_image);
        if ($this->profile_image && file_exists($path)) {
            return asset('storage/' . $this->profile_image);
        }
        return 'https://placehold.jp/100x100.png';
    }
}
