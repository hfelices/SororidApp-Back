<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoutePartner extends Model
{
    use HasFactory;
    protected $fillable = ['route', 'user', 'viewed', 'coordinates_lon_last', 'coordinates_lat_last'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}