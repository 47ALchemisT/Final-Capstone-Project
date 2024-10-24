<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'fullname',
        'email',
        'contact',
    ];
    public function studentAccount()
    {
        return $this->hasOne(StudentAccount::class, 'student_id'); 
    }
}
