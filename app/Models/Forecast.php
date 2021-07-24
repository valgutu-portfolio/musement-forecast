<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    use HasFactory;

    protected $table = 'forecast';

    protected $fillable = [
        'city_id',
        'date',
        'condition'
    ];

    protected $hidden = [
        'city_id',
        'created_at',
        'updated_at'
    ];
}
