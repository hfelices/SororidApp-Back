<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'profile_img_path',
        'name',
        'alert_password',
        'birthdate',
        'town',
        'gender',
    ];

    public function town()
    {
        return $this->belongsTo(Region::class, 'town');
    }

}
