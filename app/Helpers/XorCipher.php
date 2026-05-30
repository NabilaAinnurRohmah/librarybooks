<?php

namespace App\Helpers;

class XorCipher
{
    private static $ascii = [

        'A' => 65, 'B' => 66, 'C' => 67, 'D' => 68, 'E' => 69,
        'F' => 70, 'G' => 71, 'H' => 72, 'I' => 73, 'J' => 74,
        'K' => 75, 'L' => 76, 'M' => 77, 'N' => 78, 'O' => 79,
        'P' => 80, 'Q' => 81, 'R' => 82, 'S' => 83, 'T' => 84,
        'U' => 85, 'V' => 86, 'W' => 87, 'X' => 88, 'Y' => 89,
        'Z' => 90,

        'a' => 97, 'b' => 98, 'c' => 99, 'd' => 100, 'e' => 101,
        'f' => 102, 'g' => 103, 'h' => 104, 'i' => 105, 'j' => 106,
        'k' => 107, 'l' => 108, 'm' => 109, 'n' => 110, 'o' => 111,
        'p' => 112, 'q' => 113, 'r' => 114, 's' => 115, 't' => 116,
        'u' => 117, 'v' => 118, 'w' => 119, 'x' => 120, 'y' => 121,
        'z' => 122,

        '0' => 48, '1' => 49, '2' => 50, '3' => 51, '4' => 52,
        '5' => 53, '6' => 54, '7' => 55, '8' => 56, '9' => 57,

        ' ' => 32,
        '.' => 46,
        ',' => 44,
        '-' => 45,
        '_' => 95,
        '/' => 47,
        '@' => 64,
    ];

    private static function charToAscii($char)
    {
        return self::$ascii[$char] ?? 0;
    }

    private static function asciiToChar($ascii)
    {
        foreach (self::$ascii as $char => $code) {

            if ($code == $ascii) {
                return $char;
            }
        }

        return '';
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

    public static function encrypt($text, $key = 'PERPUS123')
    {
        $result = [];

        for ($i = 0; $i < strlen($text); $i++) {

            $asciiText = self::charToAscii(
                $text[$i]
            );

            $asciiKey = self::charToAscii(
                $key[$i % strlen($key)]
            );

            $binText = self::decimalToBinary(
                $asciiText
            );

            $binKey = self::decimalToBinary(
                $asciiKey
            );

            $result[] = self::xorBinary(
                $binText,
                $binKey
            );
        }

        return implode(' ', $result);
    }

    public static function decrypt($cipher, $key = 'PERPUS123')
    {
        $binaryData = explode(' ', $cipher);

        $result = '';

        for ($i = 0; $i < count($binaryData); $i++) {

            $binCipher = $binaryData[$i];

            $asciiKey = self::charToAscii(
                $key[$i % strlen($key)]
            );

            $binKey = self::decimalToBinary(
                $asciiKey
            );

            $binPlain = self::xorBinary(
                $binCipher,
                $binKey
            );

            $asciiPlain = self::binaryToDecimal(
                $binPlain
            );

            $result .= self::asciiToChar(
                $asciiPlain
            );
        }

        return $result;
    }
}
