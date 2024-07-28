<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory; use AuthenticableTrait;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'username',
        'password',
        'nama_admin',
        'id_level'
    ];
    protected $hidden = ['password'];
    public $timestamps = false;
    protected $with = 'level';

    function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }
}
