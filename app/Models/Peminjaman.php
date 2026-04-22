<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'nama_peminjam',
        'id_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    public function scopeDipinjam($query)
    {
        return $query->where('status', 'dipinjam');
    }

    public function scopeDikembalikan($query)
    {
        return $query->where('status', 'dikembalikan');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama_peminjam', 'ilike', "%$search%")
                ->orWhere('id_buku', 'ilike', "%$search%")
                ->orWhereHas('buku', function ($q2) use ($search) {
                    $q2->where('judul_buku', 'ilike', "%$search%");
                });
        });
    }
}
