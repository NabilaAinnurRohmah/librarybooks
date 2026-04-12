<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori_buku';
    protected $fillable = ['nama_kategori', 'detail_kategori'];
    protected $primaryKey = 'id_kategori';

    public function buku() {

        return $this->hasMany(Buku::class, 'id_kategori');
        
    }
}
