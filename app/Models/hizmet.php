<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hizmet extends Model
{
    use HasFactory;
    protected $fillable = [
        'htarih',
        'hpersure',
        'hyenileme',
    ];
}
