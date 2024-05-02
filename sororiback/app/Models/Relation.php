<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    protected $fillable = ['user_1', 'user_2', 'type', 'status'];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user_1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user_2');
    }
}