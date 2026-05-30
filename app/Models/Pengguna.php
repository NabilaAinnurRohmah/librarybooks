<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';

    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    public static function cekLogin($username, $password)
    {
        $user = self::where(
            'username',
            $username
        )->first();

        if (! $user) {
            return null;
        }

        $passwordDb =
            \App\Helpers\XorCipher::decrypt(
                $user->password
            );

        return $passwordDb === $password
            ? $user
            : null;
    }
}
