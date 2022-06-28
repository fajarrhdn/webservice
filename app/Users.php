<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
        'id', 'name', 'username', 'email', 'password'
    ];
}
