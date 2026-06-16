<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rak extends Model
{

    public static function getAll()
    {
        return DB::table('rak')->get();
    }

    public static function getById($id)
    {
        return DB::table('rak')
            ->where('id_rak', $id)
            ->first();
    }

    public static function insertData($rak)
    {
        $rak['created_at'] = now();
        $rak['updated_at'] = now();

        return DB::table('rak')->insert($rak);
    }

    public static function updateData($id, $rak)
    {
        $rak['updated_at'] = now();

        return DB::table('rak')
            ->where('id_rak', $id)
            ->update($rak);
    }

    public static function search($search)
    {
        return DB::table('rak')
            ->where('nama_rak', 'ilike', "%{$search}%")
            ->get();
    }

    public static function getAllWithBuku()
    {
        return DB::table('rak')
            ->leftJoin('buku', 'rak.id_rak', '=', 'buku.id_rak')
            ->select('rak.*', DB::raw('COUNT(buku.id_buku) as jumlah_buku'))
            ->groupBy('rak.id_rak', 'rak.nama_rak', 'rak.lokasi')
            ->get();
    }


    public static function deleteData($id)
    {
        return DB::table('rak')
            ->where('id_rak', $id)
            ->delete();
    }

}
