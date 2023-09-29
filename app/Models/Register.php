<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Register extends Model
{
    protected $fillable = ['user_email','user_password','user_login'];
    protected $hidden = ['user_password','user_token'];
    use HasFactory;
}
