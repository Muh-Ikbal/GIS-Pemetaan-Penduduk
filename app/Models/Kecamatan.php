<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $fillable = [
        'nama_kecamatan',
        'kode_pos',
        'latitude',
        'longitude',
        'geojson',
        'description',
        'image',
        'luas'
    ];

}
