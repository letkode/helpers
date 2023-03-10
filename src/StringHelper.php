<?php

namespace Letkode\Helpers;

use Jawira\CaseConverter\Convert;
use RuntimeException;

final class StringHelper
{

    public function convertValueToBoolean(string $value): bool
    {
        return match (strtoupper($value)) {
            'SI', 'TRUE', '1' => true,
            'NO', 'FALSE', '0' => false
        };
    }

    public static function pluralize($number, $base, $plural = null): string
    {
        $number = (int)$number;

        if (0 === abs($number) || abs($number) > 1) {
            if (true === is_null($plural)) {
                if (in_array(substr($base, -1, 1), ['a', 'e', 'i', 'o', 'u'])) {
                    $salida = $base.'s';
                } else {
                    $salida = $base.'es';
                }
            } else {
                $salida = $plural;
            }
        } else {
            $salida = $base;
        }

        return sprintf('%d %s', $number, $salida);
    }

    public static function getterByString(string $tag): string
    {
        return self::stringToCase(sprintf('get_%s', $tag), 'camel', '_');
    }

    public static function setterByString(string $tag): string
    {
        return self::stringToCase(sprintf('set_%s', $tag), 'camel', '_');
    }

    public static function slugify($string, $separator = '-', $nullable = false): ?string
    {
        if (!is_string($string)) {
            $string = "$string";
        }

        setlocale(LC_ALL, 'en_US.UTF8');

        if (!mb_check_encoding($string, 'UTF-8')) {
            $string = mb_convert_encoding($string, 'UTF-8');
        }

        $string = preg_replace('~[^\\pL\d]+~u', $separator, $string);
        $string = trim($string, $separator);
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        $string = strtolower($string);
        $string = preg_replace('~[^'.$separator.'\w]+~', '', $string);

        if (empty($string)) {
            return $nullable ? null:'n-a';
        }

        return $string;
    }

    public static function stringToCase(string $string, string $case, bool $hasClear = true): string
    {
        $formats = ['camel', 'pascal', 'snake', 'kebab', 'dot', 'train', 'cobol', 'ada', 'macro', 'title'];

        if (!in_array($case, $formats)) {
            throw new RuntimeException(sprintf('The %s format is not available for conversion', $case));
        }

        if ($hasClear) {
            $string = self::cleanSpecialCharacters($string, false);
        }

        $method = sprintf('to%s', ucfirst($case));

        return (new Convert($string))->{$method}();
    }

    public static function toUTF8(string $string): string
    {
        if (!mb_check_encoding($string, 'UTF-8')) {
            $string = mb_convert_encoding($string, 'UTF-8');
        }

        return trim($string);
    }

    public static function normalizeString(string $string): string
    {
        $table = [
            '??' => 'S',
            '??' => 's',
            '??' => 'Dj',
            '??' => 'dj',
            '??' => 'Z',
            '??' => 'z',
            '??' => 'C',
            '??' => 'c',
            '??' => 'C',
            '??' => 'c',
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'C',
            '??' => 'E',
            '??' => 'E',
            '??' => 'E',
            '??' => 'E',
            '??' => 'I',
            '??' => 'I',
            '??' => 'I',
            '??' => 'I',
            '??' => 'N',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'U',
            '??' => 'U',
            '??' => 'U',
            '??' => 'U',
            '??' => 'Y',
            '??' => 'B',
            '??' => 'Ss',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'c',
            '??' => 'e',
            '??' => 'e',
            '??' => 'e',
            '??' => 'e',
            '??' => 'i',
            '??' => 'i',
            '??' => 'i',
            '??' => 'i',
            '??' => 'o',
            '??' => 'n',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'u',
            '??' => 'u',
            '??' => 'u',
            '??' => 'u',
            '??' => 'y',
            '??' => 'b',
            '??' => 'y',
            '??' => 'R',
            '??' => 'r',
        ];

        return strtr($string, $table);
    }

    public static function clearSpaceWhite(string $string): string
    {
        return preg_replace("/\s+/", " ", trim(preg_replace("[\n|\r|\n\r]", "", $string)));
    }

    public static function cleanSpecialCharacters(
        string $string,
        bool $space = true,
        bool $sign = true,
        array $excludeSign = []
    ): string {
        $string = self::toUTF8(self::normalizeString($string));

        $string = strip_tags($string);
        $string = html_entity_decode($string);

        if ($space) {
            $string = str_replace(" ", "_", $string);
        }

        if ($sign) {
            $signArray = array_diff(
                [
                    "\\",
                    "??",
                    "??",
                    "-",
                    "~",
                    "#",
                    "@",
                    "|",
                    "!",
                    "\"",
                    "??",
                    "??",
                    "??",
                    "$",
                    "%",
                    "&",
                    "/",
                    "(",
                    ")",
                    "?",
                    "'",
                    "??",
                    "??",
                    "[",
                    "^",
                    "]",
                    "+",
                    "}",
                    "{",
                    "??",
                    "??",
                    ">",
                    "< ",
                    ";",
                    ",",
                    ":",
                    ".",
                    '\\n',
                    '\\t',
                ],
                $excludeSign
            );

            $string = str_replace(
                $signArray,
                '',
                $string
            );
        }

        return $string;
    }

    public static function generateHashRandom(int $length = 32): string
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";

        return substr(str_shuffle($chars), 0, $length);
    }

}