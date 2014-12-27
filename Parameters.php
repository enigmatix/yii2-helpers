<?php
/**
 * Created by PhpStorm.
 * User: Joel Small
 * Date: 26/12/14
 * Time: 2:17 PM
 */

namespace enigmatix\helpers;

class Parameters {

    static function jsonify($array)
    {
        $string = '';
        foreach ($array as $key => $value)
        {
            $string .= $key .': ' . self::jsonifyValue($value) .',
            ';
        }
        return "{".$string."}";
    }

    static function jsonifyValue($value)
    {
        if(is_array($value))
        {
            return self::jsonify($value);
        }
        if(strpos($value,'function') === false)
        {
            $value = '"'.$value.'"';
        }
        return $value;
    }

}