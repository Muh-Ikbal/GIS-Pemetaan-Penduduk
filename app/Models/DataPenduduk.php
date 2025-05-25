<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPenduduk extends Model
{
    protected $table = 'data_penduduk';
    protected $fillable = [
        'kepadatan_penduduk',
        'jumlah_penduduk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'kecamatan_id',
        'tahun'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
