<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tagihan extends Model
{
    use HasFactory; use HasRelationships;

    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';
    protected $fillable = [
        'id_penggunaan',
        'id_pelanggan',
        'bulan',
        'tahun',
        'jumlah_meter',
        'status'
    ];
    public $timestamps = false;
    protected $with = [
        'penggunaan',
        'pelanggan'
    ];

    function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan');
    }

    function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public static function prosesTagihan($id_tagihan)
    {
        return DB::statement('CALL proses_status_tagihan(?)', [$id_tagihan]);
    }
}
