<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTeams extends Model
{
    use HasFactory;

    protected $table = 'assigned_teams';

    protected $fillable = [
        'assigned_team_name',
        'college_id',
        'palakasan_id'
        
    ];

    // An assigned team belongs to one college
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
    public function palakasan()
    {
        return $this->belongsTo(Palakasan::class, 'palakasan_id');
    }
    
}

