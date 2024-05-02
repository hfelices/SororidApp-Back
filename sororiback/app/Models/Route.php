<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = ['coordinates_start', 'coordinates_end', 'time_start', 'time_end', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function routePartners()
    {
        return $this->hasMany(RoutePartner::class, 'route');
    }

    public function warnings()
    {
        return $this->hasMany(Warning::class, 'route');
    }
}