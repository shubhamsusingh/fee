<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ Required
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // ✅ Must extend this
{
    use Notifiable;

    protected $table = 'user'; // ✅ Your custom table name

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
}
