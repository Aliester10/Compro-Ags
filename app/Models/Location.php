<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'province',
        'latitude',
        'longitude',
    ];

    public function users()
{
    return $this->hasMany(User::class, 'location_id');
}
}
