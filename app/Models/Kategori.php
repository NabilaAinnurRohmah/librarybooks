<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{

    public static function getAll()
    {
        return DB::table('kategori_buku')->get();
    }

    public static function getById($id)
    {
        return DB::table('kategori_buku')
            ->where('id_kategori', $id)
            ->first();
    }

    public static function insertData($kategori)
    {
        $kategori['updated_at'] = now();
        $kategori['created_at'] = now();

        return DB::table('kategori_buku')->insert($kategori);
    }

    public static function updateData($id, $kategori)
    {
        $kategori['updated_at'] = now();

        return DB::table('kategori_buku')
            ->where('id_kategori', $id)
            ->update($kategori);
    }

    public static function search($search)
    {
        return DB::table('kategori_buku')
            ->where('nama_kategori', 'ilike', "%{$search}%")
            ->get();
    }

    public static function countData()
    {
        return DB::table('kategori_buku')->count();
    }

    public static function deleteData($id)
    {
        return DB::table('kategori_buku')
            ->where('id_kategori', $id)
            ->delete();
    }
}

