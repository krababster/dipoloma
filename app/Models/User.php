<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = ['user_name','user_phone_number','address_id','role_id','register_id','user_token'];

    protected $hidden = 'user_token';

    use HasFactory;

}
