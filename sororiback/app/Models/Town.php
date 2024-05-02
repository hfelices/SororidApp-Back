<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'region'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}