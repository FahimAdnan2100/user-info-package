<?php

namespace Fahim\InfoPackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'id',
        'name',
        'age',
        'address',
    ];

}
