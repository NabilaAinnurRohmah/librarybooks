<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $fillable = ['judul_buku', 'pengarang', 'tahun_terbit', 'penerbit', 'id_kategori'];
    protected $primaryKey = 'id_buku';

    public function kategori() {

        return $this->belongsTo(Kategori::class, 'id_kategori');
        
        }
}
