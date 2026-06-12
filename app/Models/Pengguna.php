<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    private static function charToAscii($char)
    {
        return ord($char);
    }

    private static function asciiToChar($ascii)
    {
        return chr($ascii);
    }

    private static function decimalToBinary($number)
    {
        if ($number == 0) {
            return '00000000';
        }

        $binary = '';

        while ($number > 0) {

            $binary = ($number % 2).$binary;

            $number = (int) ($number / 2);
        }

        while (strlen($binary) < 8) {

            $binary = '0'.$binary;
        }

        return $binary;
    }

    private static function binaryToDecimal($binary)
    {
        $decimal = 0;

        $power = 0;

        for ($i = strlen($binary) - 1; $i >= 0; $i--) {

            if ($binary[$i] == '1') {
                $decimal += 2 ** $power;
            }

            $power++;
        }

        return $decimal;
    }

    private static function textToBinary($text)
    {
        $result = [];

        for ($i = 0; $i < strlen($text); $i++) {

            $ascii = self::charToAscii(
                $text[$i]
            );

            $result[] = self::decimalToBinary(
                $ascii
            );
        }

        return $result;
    }

    private static function xorBinary($bin1, $bin2)
    {
        $hasil = '';

        for ($i = 0; $i < 8; $i++) {

            if ($bin1[$i] == $bin2[$i]) {

                $hasil .= '0';

            } else {

                $hasil .= '1';
            }
        }

        return $hasil;
    }

    public static function decrypt($cipher)
    {
        $key = 'PERPUS123';

        if (empty($cipher)) {
            return null;
        }

        $cipherBinary = explode(' ', trim($cipher));
        $keyBinary = self::textToBinary($key);

        $result = '';
        $keyLength = count($keyBinary);

        for ($i = 0; $i < count($cipherBinary); $i++) {

            $xor = self::xorBinary(
                $cipherBinary[$i],
                $keyBinary[$i % $keyLength]
            );

            $decimal = self::binaryToDecimal($xor);

            if ($decimal >= 0 && $decimal <= 255) {
                $result .= self::asciiToChar($decimal);
            }
        }

        return $result;
    }

    public static function encrypt($text)
    {
        $key = 'PERPUS123';

        $textBinary = self::textToBinary($text);
        $keyBinary = self::textToBinary($key);

        $result = [];

        $keyLength = count($keyBinary);

        for ($i = 0; $i < count($textBinary); $i++) {

            $result[] = self::xorBinary(
                $textBinary[$i],
                $keyBinary[$i % $keyLength]
            );
        }

        return implode(' ', $result);
    }

    public static function cekLogin($username, $password)
    {
        $user = DB::table('pengguna')
            ->where(
                'username',
                $username
            )
            ->first();

        if (! $user) {
            return null;
        }

        $passwordDb = self::decrypt(
            $user->password
        );

        if ($passwordDb === $password) {

            return $user;
        }

        return null;
    }

    public static function getById($id)
    {
        return DB::table('pengguna')
            ->where('id_pengguna', $id)
            ->first();
    }

    public static function getByUsername($username)
    {
        return DB::table('pengguna')
            ->where('username', $username)
            ->first();
    }

    public static function insertData($data)
    {
        $data['created_at'] = now();
        $data['updated_at'] = now();

        return DB::table('pengguna')
            ->insertGetId($data, 'id_pengguna');

    }

    public static function updateData($id, $data)
    {
        return DB::table('pengguna')
            ->where('id_pengguna', $id)
            ->update($data);
    }
}
