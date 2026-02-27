<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters';

    protected $fillable = [
        'course_id',
        'semester_name',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Semester belongs to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Semester has many Students
    public function students()
    {
        return $this->hasMany(Students::class);
    }
}
