<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_anggota',
        'id_buku',
        'judul_buku',
        'tanggal_pinjam',
        'jatuh_tempo',
        'tanggal_kembali',
        'status',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {

            $q->whereHas('anggota', function ($q2) use ($search) {
                $q2->where('nama', 'ilike', "%$search%");
            })
                ->orWhere('id_buku', 'ilike', "%$search%")
                ->orWhere('status', 'ilike', "%$search%")
                ->orWhereRaw('CAST(tanggal_pinjam AS TEXT) ILIKE ?', ["%$search%"])
                ->orWhereRaw('CAST(jatuh_tempo AS TEXT) ILIKE ?', ["%$search%"])
                ->orWhereRaw('CAST(tanggal_kembali AS TEXT) ILIKE ?', ["%$search%"])
                ->orWhereHas('buku', function ($q2) use ($search) {
                    $q2->where('judul_buku', 'ilike', "%$search%");
                });
        });
    }

    public function prosesPengembalian()
    {
        if ($this->status == 'dikembalikan') {
            return false;
        }

        $this->buku->increment('stok');

        $this->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        return true;
    }

    public function getDurasiAttribute()
    {
        $tanggal_pinjam = Carbon::parse($this->tanggal_pinjam);

        $tanggal = $this->status == 'dipinjam'
             ? now()
             : Carbon::parse($this->tanggal_kembali);

        return $tanggal_pinjam->diffInDays($tanggal);
    }

    public function getKeterlambatanAttribute()
    {
        if (! $this->jatuh_tempo) {
            return 0;
        }

        $batas = Carbon::parse($this->jatuh_tempo);

        $tanggal = $this->status == 'dipinjam'
             ? now()
             : Carbon::parse($this->tanggal_kembali);

        return $tanggal->gt($batas)
            ? $tanggal->diffInDays($batas)
            : 0;
    }
}
