<?php

namespace Src\Support;

class Arr 
{

    public static function only($array, $keys) 
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }


    public static function forget(&$array, $keys) 
    {
        $original = &$array;

        $keys = (array) $keys;

        if (!count($keys)) {
            return;
        }

        foreach ($keys as $key) {
            if(static::exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = explode('.', $key);

            while (count($parts) > 1) {
                $part = array_shift($parts);
                if(isset($array[$part]) && is_array($array[$part])){
                    $array = &$array[$part];
                } else {
                    continue;
                }
            }

            unset($array[array_shift($parts)]);
        }
    }


    public static function accessible($value) 
    {
        return is_array($value) || ($value instanceof \ArrayAccess);
    }


    public static function exists($array, $key) 
    {
        if ($array instanceof \ArrayAccess) {
            return $array->offsetExists($key);
        }

        return array_key_exists($key, $array);
    }


    public static function has($array, $keys) 
    {
        if(is_null($keys)) {
            return false;
        }

        $keys = (array) $keys;

        if ($keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $subArray = $array;

            if(static::exists($array, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if(static::accessible($subArray) && static::exists($subArray, $segment)) {
                    $subArray = $subArray[$segment];
                } else {
                    return false;
                }
            }
        }

        return true;
    }


    public static function last($array, $callback = null, $default = null) {
        if (is_null($callback)) {
            return empty($array) ? value($default) : end($array);
        }

        return static::first(array_reverse($array, true), $callback, $default);
    }


    public static function first($array, $callback = null, $default = null) {
        if (is_null($callback)) {
            if (empty($array)) {
                return value($default);
            };

            foreach ($array as $item) {
                return $item;
            }
        }

        foreach ($array as $key => $value) {
            if(call_user_func($callback, $value, $key)) {
                return $value;
            }
        }

        return value($default);
    }
}