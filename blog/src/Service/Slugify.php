<?php


namespace App\Service;


class Slugify
{

    public function generate(string $input) : string
    {
        $string = iconv ('utf-8', 'ascii//TRANSLIT//IGNORE', mb_strtolower($input));
        $string = preg_replace ('/[^\w ]/', '', $string);

        return preg_replace('/ +/', '-', trim($string));
    }
}