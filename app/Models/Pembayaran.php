<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Pembayaran extends Model
{
    use HasFactory; use hasRelationships;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = [
        'id_tagihan',
        'id_pelanggan',
        'tanggal_pembayaran',
        'bulan_bayar',
        'biaya_admin',
        'total_bayar',
        'id_user'
    ];
    public $timestamps = false;
    protected $with = [
        'tagihan',
        'pelanggan'
    ];

    function tagihan(){
        return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }
    function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    /**
     * @param $id_tagihan
     * @param $id_user
     * @return bool
     */
    public static function confirmBayar($id_tagihan, $id_user)
    {
        return DB::statement('CALL confirm_status_tagihan(?, ?)', [$id_tagihan, $id_user]);
    }
}
