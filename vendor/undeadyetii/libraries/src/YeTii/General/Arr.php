<?php

namespace YeTii\General;

/**
 * Class Arr
 */
class Arr
{
    /**
     * @var array|mixed
     */
    public $value;

    /**
     * Arr constructor.
     */
    public function __construct()
    {
        $arr = [];
        if (func_num_args() == 1 && is_array(func_get_arg(0))) {
            $arr = func_get_arg(0);
        } else {
            foreach (func_get_args() as $part) {
                $arr[] = $part;
            }
        }
        $this->value = $arr;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            array_unshift($arguments, $this->value);

            return call_user_func_array([$this, $name], $arguments);
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $s = new YeTii\General\Arr();

        return call_user_func_array([$s, $name], $arguments);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->value);
    }

    /**
     * @return array|mixed
     */
    public function toArray()
    {
        return $this->value;
    }

    /**
     * @return object
     */
    public function toObject()
    {
        return (object)$this->value;
    }

    /**
     * @param array $haystack
     * @param       $needle
     * @param null  $default
     * @return false|int|null|string
     */
    private function indexOf(array $haystack, $needle, $default = null)
    {
        $index = array_search($needle, $haystack);

        return $index ? $index : $default;
    }

    /**
     * @param array $haystack
     * @param       $needle
     * @param array $default
     * @return array
     */
    private function indexesOf(array $haystack, $needle, $default = [])
    {
        $indexes = [];
        foreach ($haystack as $index => $straw) {
            if ($straw === $needle) {
                $indexes[] = $index;
            }
        }

        return $indexes ? $indexes : $default;
    }

    /**
     * @param array $haystack
     * @param       $index
     * @param null  $default
     * @return mixed|null
     */
    private function at(array $haystack, $index, $default = null)
    {
        return isset($haystack[$index]) ? $haystack[$index] : $default;
    }

    /**
     * @param array  $array
     * @param        $key
     * @param null   $default
     * @param string $delim
     * @return array|mixed|null
     */
    private function get(array $array, $key, $default = null, $delim = '.')
    {
        $keys = explode($delim, $key);
        $tmp = &$array;
        foreach ($keys as $k) {
            if (isset($tmp[$k])) {
                $tmp = $tmp[$k];
            } else {
                return $default;
            }
        }

        return $tmp;
    }

    /**
     * @param array  $array
     * @param        $key
     * @param null   $value
     * @param string $delim
     * @return $this
     */
    private function set(array $array, $key, $value = null, $delim = '.')
    {
        $keys = explode($delim, $key);
        $tmp = &$array;
        foreach ($keys as $k) {
            if (isset($tmp[$k])) {
                $tmp = &$tmp[$k];
            } else {
                $tmp[$k] = [];
            }
        }
        $tmp = $value;
        printDie($array);
        $this->value = $array;

        return $this;
    }

    /**
     * @return mixed
     */
    private function extend()
    {
        $arrays = func_get_args();
        $base = array_shift($arrays);
        foreach ($arrays as $array) {
            if (is_object($array) && get_class($array) == 'YeTii\General\Arr') {
                $array = $array->toArray();
            }
            reset($base);
            while (list($key, $value) = @each($array)) {
                $base[$key] = is_array($value) && @is_array($base[$key]) ? $this->extend($base[$key],
                    $value) : $base[$key] = $value;
            }
        }

        return $base;
    }

    /**
     * @return $this
     */
    private function merge()
    {
        $arr = call_user_func_array([$this, 'extend'], func_get_args());
        $this->value = $arr;

        return $this;
    }

    /**
     * @param array $array
     * @return $this
     */
    private function shuffle(array $array)
    {
        shuffle($array);
        $this->value = $array;

        return $this;
    }

    /**
     * @param array $array
     * @return int
     */
    private function length(array $array)
    {
        return count($array);
    }

    /**
     * @param array $array
     * @return array
     */
    private function keys(array $array)
    {
        return array_keys($array);
    }

    /**
     * @param array $array
     * @return array
     */
    private function values(array $array)
    {
        return array_values($array);
    }

    /**
     * @param array $array
     * @param       $function
     * @return array
     */
    private function map(array $array, $function)
    {
        return array_map($function, $array);
    }

    /**
     * @param array $array
     * @param       $add
     * @return $this
     */
    private function append(array $array, $add)
    {
        array_push($array, $add);
        $this->value = $array;

        return $this;
    }

    /**
     * @param array $array
     * @param       $add
     * @return $this
     */
    private function prepend(array $array, $add)
    {
        array_unshift($array, $add);
        $this->value = $array;

        return $this;
    }

    /**
     * @param array $array
     * @param int   $length
     * @return array|bool
     */
    private function last(array $array, int $length = 1)
    {
        if (!$length) {
            return false;
        }
        if ($length >= $this->length($array)) {
            return $array;
        }
        $arr = [];
        for ($i = 0; $i < $length; $i++) {
            $arr[] = array_pop($array);
        }
        $this->value = $array;

        return $arr;
    }

    /**
     * @param array $array
     * @param int   $length
     * @return array|bool
     */
    private function first(array $array, int $length = 1)
    {
        if (!$length) {
            return false;
        }
        if ($length >= $this->length($array)) {
            return $array;
        }
        $arr = [];
        for ($i = 0; $i < $length; $i++) {
            $arr[] = array_shift($array);
        }
        $this->value = $array;

        return $arr;
    }
}