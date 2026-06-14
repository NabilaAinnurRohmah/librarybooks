<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = ['nama', 'alamat', 'no_hp', 'id_pengguna'];

    protected $primaryKey = 'id_anggota';

    public static function getAll()
    {
        return DB::table('anggota')->get();
    }

    public static function getById($id)
    {
        return DB::table('anggota')
            ->leftJoin('pengguna', 'anggota.id_pengguna', '=', 'pengguna.id_pengguna')
            ->select('anggota.*', 'pengguna.username')
            ->where('anggota.id_anggota', $id)
            ->first();
    }

    public static function getWithoutPengguna()
    {
        return DB::table('anggota')
            ->whereNull('id_pengguna')
            ->get();
    }

    public static function insertData($data)
    {
        $data['created_at'] = now();
        $data['updated_at'] = now();

        return DB::table('anggota')
            ->insert($data);
    }

    public static function updateData($id, $data)
    {
        return DB::table('anggota')
            ->where('id_anggota', $id)
            ->update($data);
    }

    public static function deleteData($id)
    {
        return DB::table('anggota')
            ->where('id_anggota', $id)
            ->delete();
    }

    public static function getByPengguna($id_pengguna)
    {
        return DB::table('anggota')
            ->where('id_pengguna', $id_pengguna)
            ->first();
    }
}
