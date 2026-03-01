<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'student_id',
        'fee_structure_id',
        'amount_paid',
        'payment_mode',
        'transaction_id',
        'payment_date',
        'status',
        'due_date',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount_paid' => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Payment belongs to Student
    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    // Payment belongs to FeeStructure
    public function feeStructure()
    {
        return $this->belongsTo(feeStructure::class, 'fee_structure_id');
    }

    public function installments()
    {
        return $this->hasMany(Installement::class);
    }
}
