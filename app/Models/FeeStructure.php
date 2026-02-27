<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;

    protected $table = 'fee_structures';

    protected $fillable = [
        'course_id',
        'semester_id',
        'tuition_fee',
        'exam_fee',
        'library_fee',
        'other_fee',
        'total_amount',
    ];

    // protected $casts = [
    //     'tuition_fee' => 'float',
    //     'exam_fee' => 'float',
    //     'library_fee' => 'float',
    //     'other_fee' => 'float',
    //     'total_amount' => 'decimal:2',
    // ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // FeeStructure belongs to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // FeeStructure belongs to Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // One FeeStructure can have many Payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
