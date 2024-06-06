<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = [
        'coordinates_lon_start',
        'coordinates_lat_start', 
        'coordinates_lat_end', 
        'coordinates_lon_end',
        'coordinates_lat_not',
        'coordinates_lon_now', 
        'time_start',
        'time_estimated',
        'time_user_end', 
        'time_end',
        'share',
        'status', 
        'user'];

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