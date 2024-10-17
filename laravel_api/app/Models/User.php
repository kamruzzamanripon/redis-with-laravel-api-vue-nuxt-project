<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_admin',
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

    public function scopeAmbassadors($query): mixed
    {
        return $query->where('is_admin', 0);
    }

    public function scopeAdmins($query): mixed
    {
        return $query->where('is_admin', 1);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)->where('complete', 1);
    }

    public function getRevenueAttribute(): mixed
    {
        return $this->orders->sum(fn(Order $order): mixed => $order->ambassador_revenue);
    }

    public function getNameAttribute(): string  
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
