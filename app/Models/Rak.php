<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'rak';

    protected $fillable = ['nama_rak', 'lokasi'];

    protected $primaryKey = 'id_rak';

    public function buku()
    {

        return $this->hasMany(Buku::class, 'id_rak');

    }

    public function scopeSearch($query, $search)
    {

        return $query->where('nama_rak', 'ilike', "%$search%");

    }
}
