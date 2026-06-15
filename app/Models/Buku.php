<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buku extends Model
{

    public static function getAll()
    {
        return DB::table('buku')
            ->Join('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id_kategori')
            ->Join('rak', 'buku.id_rak', '=', 'rak.id_rak')
            ->select('buku.*', 'kategori_buku.nama_kategori', 'rak.nama_rak')
            ->get();
    }

    public static function getById($id)
    {
        return DB::table('buku')
            ->Join('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id_kategori')
            ->Join('rak', 'buku.id_rak', '=', 'rak.id_rak')
            ->select('buku.*', 'kategori_buku.nama_kategori', 'rak.nama_rak')
            ->where('id_buku', $id)
            ->first();
    }

    public static function insertData($data)
    {
        $data['created_at'] = now();
        $data['updated_at'] = now();

        return DB::table('buku')->insert($data);
    }

    public static function updateData($id, $data)
    {
        $data['updated_at'] = now();

        return DB::table('buku')
            ->where('id_buku', $id)
            ->update($data);
    }

    public static function deleteData($id)
    {
        return DB::table('buku')
            ->where('id_buku', $id)
            ->delete();
    }

    public static function search($search)
    {
        return DB::table('buku')
            ->Join('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id_kategori')
            ->Join('rak', 'buku.id_rak', '=', 'rak.id_rak')
            ->where(function ($q) use ($search) {

                $q->where('judul_buku', 'ilike', "%{$search}%")
                    ->orWhere('pengarang', 'ilike', "%{$search}%")
                    ->orWhere('nama_kategori', 'ilike', "%{$search}%")
                    ->orWhere('nama_rak', 'ilike', "%{$search}%");
            })
            ->select('buku.*', 'kategori_buku.nama_kategori', 'rak.nama_rak')
            ->get();
    }

    public static function getByRak($id_rak)
    {
        return DB::table('buku')
            ->Join('kategori_buku', 'buku.id_kategori','=', 'kategori_buku.id_kategori')
            ->select('buku.*', 'kategori_buku.nama_kategori')
            ->where('buku.id_rak', $id_rak)
            ->get();
    }

    public static function kurangiStok($id)
    {
        return DB::table('buku')
            ->where('id_buku', $id)
            ->decrement('stok');
    }

    public static function tambahStok($id)
    {
        return DB::table('buku')
            ->where('id_buku', $id)
            ->increment('stok');
    }

    public static function countData()
    {
        return DB::table('buku')
            ->count();
    }

    public static function getLatest($limit = 5)
    {
        return DB::table('buku')
            ->Join('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id_kategori')
            ->select('buku.*', 'kategori_buku.nama_kategori')
            ->orderByDesc('buku.id_buku')
            ->limit($limit)
            ->get();
    }
}
