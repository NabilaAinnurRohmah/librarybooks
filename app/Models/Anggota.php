<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = ['nama', 'alamat', 'no_hp', 'id_pengguna'];

    protected $primaryKey = 'id_anggota';

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota');
    }
}
