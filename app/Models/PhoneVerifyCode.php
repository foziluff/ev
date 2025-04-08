<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneVerifyCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'phone', 'tries'];
}
