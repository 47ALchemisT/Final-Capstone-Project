<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedSports extends Model
{
    use HasFactory;

    protected $table = 'assigned_sports';

    protected $fillable = [
        'palakasan_sport_id',
        'sport_id',
        'categories',
        'setup',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }
    
    public function palakasan()
    {
        return $this->belongsTo(Palakasan::class, 'palakasan_sport_id');
    }

}
