<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    public $incrementing = false;
    protected $primaryKey = null;

    
    protected $fillable = [
        'email', 'token', 'created_at', 'update_at'
    ];
}