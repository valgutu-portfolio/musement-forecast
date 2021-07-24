<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'musementapi_id',
        'name',
        'latitude',
        'longitude'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function forecast(): HasMany
    {
        return $this->hasMany(Forecast::class, 'city_id');
    }
}
