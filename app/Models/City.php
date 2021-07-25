<?php

namespace App\Models;

use Carbon\Carbon;
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
        'longitude',
        'forecast_update_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function setForecastUpdateDate($value)
    {
        $this->attributes['forecast_update_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function forecast(): HasMany
    {
        return $this->hasMany(Forecast::class, 'city_id');
    }
}
