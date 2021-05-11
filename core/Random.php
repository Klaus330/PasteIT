<?php


namespace app\core;


class Random
{
    public static function generate()
    {
        $length = 15;
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $size = strlen($chars);
        $str = null;
        for ($i = 0; $i < $length; $i++) {
            $str = $str.$chars[rand(0, $size - 1)];
        }
        return $str;
    }
}