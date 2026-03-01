<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function student()
    {
        return $this->hasOne(Students::class);
    }
}
