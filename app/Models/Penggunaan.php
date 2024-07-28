<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Penggunaan extends Model
{
    use HasFactory; use HasRelationships; use HasEvents;

    protected $table = 'penggunaan';
    protected $primaryKey = 'id_penggunaan';
    protected $fillable = [
        'id_pelanggan',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir'
    ];
    public $timestamps = false;
    protected $with = 'pelanggan';

    function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
