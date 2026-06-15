<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Model
{

    public static function getAllDipinjam()
    {
        return DB::table('peminjaman')
            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->select('peminjaman.*', 'anggota.nama', 'buku.judul_buku')
            ->where('status', 'dipinjam')
            ->orderByDesc('id_peminjaman')
            ->get();
    }

    public static function getById($id)
    {
        return DB::table('peminjaman')
            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->select('peminjaman.*', 'anggota.nama', 'buku.judul_buku')
            ->where('id_peminjaman', $id)
            ->first();
    }

    public static function insertData($data)
    {
        $data['created_at'] = now();
        $data['updated_at'] = now();

        return DB::table('peminjaman')
            ->insert($data);
    }

    public static function updateData($id, $data)
    {
        $data['updated_at'] = now();

        return DB::table('peminjaman')
            ->where('id_peminjaman', $id)
            ->update($data);
    }

    public static function deleteData($id)
    {
        return DB::table('peminjaman')
            ->where('id_peminjaman', $id)
            ->delete();
    }

    public static function getDurasi($data)
    {
        $tanggalPinjam = Carbon::parse(
            $data->tanggal_pinjam
        );

        $tanggal = $data->status == 'dipinjam'
            ? now()
            : Carbon::parse(
                $data->tanggal_kembali
            );

        return $tanggalPinjam
            ->diffInDays($tanggal);
    }

    public static function getKeterlambatan($data)
    {
        if (! $data->jatuh_tempo) {
            return 0;
        }

        $batas = Carbon::parse($data->jatuh_tempo);

        $tanggal = $data->status == 'dipinjam'
            ? now()
            : Carbon::parse($data->tanggal_kembali);

        return $tanggal->gt($batas)
            ? $tanggal->diffInDays($batas)
            : 0;
    }

    public static function getAllDikembalikan()
    {
        return DB::table('peminjaman')
            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->select('peminjaman.*', 'anggota.nama', 'buku.judul_buku')
            ->where('status', 'dikembalikan')
            ->orderByDesc('id_peminjaman')
            ->get();
    }

    public static function prosesPengembalian($id)
    {
        $data = self::getById($id);

        if (! $data) {
            return false;
        }

        if ($data->status == 'dikembalikan') {
            return false;
        }

        Buku::tambahStok($data->id_buku);

        return DB::table('peminjaman')
            ->where('id_peminjaman', $id)
            ->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => now(),
            ]);
    }

    public static function getByAnggotaDipinjam($id_anggota)
    {
        return DB::table('peminjaman')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->select('peminjaman.*', 'buku.judul_buku')
            ->where('peminjaman.id_anggota', $id_anggota)
            ->where('peminjaman.status', 'dipinjam')
            ->orderByDesc('peminjaman.id_peminjaman')
            ->get();
    }

    public static function getByAnggotaDikembalikan($id_anggota)
    {
        return DB::table('peminjaman')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->select('peminjaman.*', 'buku.judul_buku')
            ->where('peminjaman.id_anggota', $id_anggota)
            ->where('peminjaman.status', 'dikembalikan')
            ->orderByDesc('peminjaman.id_peminjaman')
            ->get();
    }

    public static function countByStatus($status)
    {
        return DB::table('peminjaman')
            ->where('status', $status)
            ->count();
    }
}
