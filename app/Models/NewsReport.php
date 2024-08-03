<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NewsReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'units',
        'address',
        'personnel',
        'start_time',
        'end_time',
        'activities',
        'others',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    // Métodos de mutación para los campos de tiempo
    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::createFromFormat('H:i', $value);
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::createFromFormat('H:i', $value);
    }
}
