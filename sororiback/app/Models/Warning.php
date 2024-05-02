<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;
    protected $fillable = ['route', 'reason', 'details'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}