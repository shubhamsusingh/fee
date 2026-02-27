<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'roll_no',
        'course_id',
        'semester_id',
        'phone',
        'address',
        'admission_date',
        'status',
    ];

    // Student belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Student belongs to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Student belongs to Semester
    public function semester()
    {
        return $this->belongsTo(semester::class);
    }
}
