<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'made_profile',
        'role',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the gender attribute.
     *
     * @param  mixed  $value
     * @return string
     */
    public function getGenderAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the locations relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Get the relations relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relations()
    {
        return $this->hasMany(Relation::class, 'user_1');
    }

    /**
     * Get the profile relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'id_user');
    }

    /**
     * Check if the user can access Filament.
     *
     * @return bool
     */
    public function canAccessFilament(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the Filament avatar URL.
     *
     * @return ?string
     */
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    /**
     * Get the Filament name.
     *
     * @return string
     */
    public function getFilamentName(): string
    {
        return $this->profile->name ?? $this->email;
    }

    /**
     * Check if the user can access a specific Filament panel.
     *
     * @param  string  $panel
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->canAccessFilament();
    }
}
// Todo el código de backend (excepto la base de laravel, filament y otros paquetes) hecho por: Mark López Morales