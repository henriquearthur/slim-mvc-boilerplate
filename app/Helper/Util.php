<?php

namespace App\Helper;

class Util
{
    public function clearString($content)
    {
        if (is_array($content)) {
            return filter_var_array($content, FILTER_SANITIZE_STRING);
        } else {
            return filter_var($content, FILTER_SANITIZE_STRING);
        }
    }

    public function timestampToDatetime(int $timestamp)
    {
        return date('Y-m-d H:i:s', $timestamp);
    }

    public function getGeolocation()
    {
        $geolocation = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : null;

        return $geolocation;
    }

    public function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('-', '', ucwords($string, '-'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    public function camelCaseToDashes($str)
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $str));
    }
}
