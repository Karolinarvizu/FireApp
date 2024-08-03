<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallationReport extends Model
{
    protected $table = 'installation_reports';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'cleaned_rooms',
        'notes',
    ];

    protected $casts = [
        'cleaned_rooms' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
