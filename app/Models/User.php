<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = ['user_name','user_login','user_password','user_email','user_phone-number','address_id','user_token'];
    use HasFactory;
}
