<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = ['judul_buku', 'pengarang', 'tahun_terbit', 'penerbit', 'sinopsis', 'stok', 'id_kategori'];

    protected $primaryKey = 'id_buku';

    public function kategori()
    {

        return $this->belongsTo(Kategori::class, 'id_kategori');

    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('judul_buku', 'ilike', "%$search%")
                ->orWhere('pengarang', 'ilike', "%$search%")
                ->orWhereHas('kategori', function ($q2) use ($search) {
                    $q2->where('nama_kategori', 'ilike', "%$search%");
                });
        });
    }
}
