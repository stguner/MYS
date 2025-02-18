<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class musteri extends Model
{
    use HasFactory;

    protected $table = 'musteriler';

    protected $fillable = [
    'mkayitturu',
    'mturu',
    'mvdairesi',
    'mtcknvno',
    'mbadi',
    'mbsoyadi',
    'mbdogumgunu',
    'mbfirmaadi',
    'mbunvani',
    'mbankadi',
    'miban',
    'madres',
    'mbolge',
    'milce',
    'mil',
    'mtel',
    'mfaks',
    'meposta',
    'mweb',
    'menlem',
    'mboylam',
    'mnot',
    'mkullaniciadi',
    'msifre',
    'maktif',
    'mphoto',
    ];
}
