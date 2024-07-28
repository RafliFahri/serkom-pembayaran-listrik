<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class Pelanggan extends Model implements Authenticatable
{
    use HasFactory; use AuthenticatableTrait;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = [
        'username',
        'password',
        'nomor_kwh',
        'alamat_pelanggan',
        'id_tarif'
    ];
    protected $hidden = ['password'];
    public $timestamps = false;
    protected $with = 'tarif';

    function tarif(){
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }
}
