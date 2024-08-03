<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitReport extends Model
{
    protected $table = 'unit_reports';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'units',
        'gas_diesel_status',
        'gas_diesel_notes',
    ];

    protected $casts = [
        'units' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
