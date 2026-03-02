<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installement extends Model
{
    use HasFactory;

    protected $table = 'installments';

    protected $fillable = [
        'payment_id',
        'installment_no',
        'amount',
        'paid_date',
        'status',
        'transaction_id',
        'payment_mode',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
