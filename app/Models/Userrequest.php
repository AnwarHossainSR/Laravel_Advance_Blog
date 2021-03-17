<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userrequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'name',
        'email',
        'status',
        'type',
        'reqType',
        'message',
        'totalComment',
        'profileImage',
        'joined',
    ];
    
}
