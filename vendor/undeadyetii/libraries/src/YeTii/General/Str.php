<?php

namespace YeTii\General;

/**
 * Class Str
 */
class Str
{
    /**
     * @var string
     */
    public $value;

    /**
     * Str constructor.
     * @param null $str
     */
    public function __construct($str = null)
    {
        if (!is_null($str)) {
            $this->value = (string)$str;
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            // array_unshift($arguments, $this->value);

            $s = new Str($this->value);
            return call_user_func_array([$s, $name], $arguments);
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        if (!is_array($arguments)||empty($arguments))
            return new Str();

        $str = array_shift($arguments);
        $s = new Str($str);

        return call_user_func_array([$s, $name], $arguments);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->value;
    }

    /**
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool
     */
    private function contains(string $needle, $ignoreCase = false)
    {
        $value = $this->value;
        return boolval($ignoreCase ? substr_count(strtolower($value), strtolower($needle)) : substr_count($value, $needle));
    }

    /**
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool|int
     */
    private function indexFirst(string $needle, $ignoreCase = false)
    {
        $value = $this->value;
        return $ignoreCase ? stripos($value, $needle) : strpos($value, $needle);
    }

    /**
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool|int
     */
    private function indexLast(string $needle, $ignoreCase = false)
    {
        $value = $this->value;
        return $ignoreCase ? strripos($value, $needle) : strrpos($value, $needle);
    }

    /**
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool
     */
    private function startsWith(string $needle, $ignoreCase = false)
    {
        $value = $this->value;
        return boolval($needle === ""
                       || ($ignoreCase ? strripos($value, $needle, -strlen($value)) : strrpos($value, $needle,
                -strlen($value))) !== false);
    }

    /**
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool
     */
    private function endsWith(string $needle, $ignoreCase = false)
    {
        $value = $this->value;
        return boolval($needle === ""
                       || (($temp = strlen($value) - strlen($needle)) >= 0
                           && ($ignoreCase ? stripos($value, $needle, $temp) : strpos($value, $needle, $temp)) !== false));
    }

    /**
     * @param string $delimiter
     * @param bool   $ignoreCase
     * @return $this
     */
    private function afterLast(string $delimiter, $ignoreCase = false)
    {
        $value = $this->value;
        $pos = $this->indexLast($delimiter, $ignoreCase);
        $this->value = $pos ? substr($value, $pos+strlen($delimiter)) : $value;

        return $this;
    }

    /**
     * @param string $delimiter
     * @param bool   $ignoreCase
     * @return $this
     */
    private function beforeLast(string $delimiter, $ignoreCase = false)
    {
        $value = $this->value;
        $pos = $this->indexLast($delimiter, $ignoreCase);
        $this->value = $pos ? substr($value, 0, $pos) : $value;

        return $this;
    }

    /**
     * @param string $delimiter
     * @param bool   $ignoreCase
     * @return $this
     */
    private function afterFirst(string $delimiter, $ignoreCase = false)
    {
        $value = $this->value;
        $pos = $this->indexFirst($delimiter, $ignoreCase);
        $this->value = $pos ? substr($value, $pos+strlen($delimiter)) : '';

        return $this;
    }

    /**
     * @param string $delimiter
     * @param bool   $ignoreCase
     * @return $this
     */
    private function beforeFirst(string $delimiter, $ignoreCase = false)
    {
        $value = $this->value;
        $pos = $this->indexFirst($delimiter, $ignoreCase);
        $this->value = $pos ? substr($value, 0, $pos) : $value;

        return $this;
    }

    /**
     * @param int    $length
     * @return $this
     */
    private function first(int $length)
    {
        $value = $this->value;
        $this->value = strlen($value) < $length ? $value : substr($value, 0, $length);

        return $this;
    }

    /**
     * @param int    $length
     * @return $this
     */
    private function last(int $length)
    {
        $value = $this->value;
        $this->value = strlen($value) < $length ? $value : substr($value, -$length);

        return $this;
    }

    /**
     * @return bool
     */
    private function isLowerCase()
    {
        $value = $this->value;
        return boolval($value === strtolower($value));
    }

    /**
     * @return bool
     */
    private function isUpperCase()
    {
        $value = $this->value;
        return boolval($value === strtoupper($value));
    }

    /**
     * @return $this
     */
    private function toLowerCase()
    {
        $value = $this->value;
        $this->value = strtolower($value);

        return $this;
    }

    /**
     * @return $this
     */
    private function toUpperCase()
    {
        $value = $this->value;
        $this->value = strtoupper($value);

        return $this;
    }

    /**
     * @return bool
     */
    private function isCapitalized()
    {
        $value = $this->value;
        return boolval(strlen($value) ? $value[0] == strtoupper($value[0]) : false);
    }

    /**
     * @param bool   $forceLowerCaseOther
     * @return bool
     */
    private function isCapitalizedWords($forceLowerCaseOther = false)
    {
        $value = $this->value;
        return boolval($value == strval($this->capitalizeWords($forceLowerCaseOther)));
    }

    /**
     * @param bool   $forceLowerCaseOther
     * @return $this
     */
    private function capitalizeWords($forceLowerCaseOther = false)
    {
        $value = $this->value;
        $value = $forceLowerCaseOther ? ucwords(strtolower($value)) : ucwords($value);

        foreach (['-', '\'', '.', ' '] as $delimiter) {
            if (strpos($value, $delimiter) !== false) {
                $value = implode($delimiter, array_map('ucfirst', explode($delimiter, $value)));
            }
        }
        $this->value = $value;

        return $this;
    }

    /**
     * @param bool   $forceLowerCaseOther
     * @return $this
     */
    private function capitalizeTitle($forceLowerCaseOther = false)
    {
        $value = $this->value;
        $words = explode(' ', $this->capitalizeWords($forceLowerCaseOther));
        for ($i = 0; $i < count($words); $i++) {
            if (!$i) {
                continue;
            }
            $word = $words[$i];
            $prevword = isset($words[$i - 1]) ? $words[$i - 1] : null;
            if (in_array(strtolower($word), ['a', 'in', 'for', 'the', 'of', 'if', 'on', 'to'])
                && !preg_match('/[\.\:\!\?]$/', $prevword)) {
                $word = strtolower($word);
            } elseif (Num::isRomanNumerals(preg_replace('/[\W]+/', '', strtoupper($word)))) {
                $word = strtoupper($word);
            }
            $words[$i] = $word;
        }
        $this->value = implode(' ', $words);

        return $this;
    }

    /**
     * @return bool
     */
    private function isRomanNumerals()
    {
        $value = $this->value;
        return boolval(Num::isRomanNumerals($value));
    }

    /**
     * @param string      $find
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replace(string $find, string $replace = null, $ignoreCase = false)
    {
        $value = $this->value;
        $this->value = $ignoreCase ? str_ireplace($find, $replace, $value) : str_replace($find, $replace, $value);

        return $this;
    }

    /**
     * @param string      $find
     * @param string      $replace
     * @return $this
     */
    private function replaceRegex(string $find, string $replace = '')
    {
        $value = $this->value;
        $this->value = preg_replace($find, $replace, $value);

        return $this;
    }

    /**
     * Alias of replaceRegex();
     * @param string      $find
     * @param string      $replace
     * @return $this
     */
    private function regexReplace(string $find, string $replace = '') {
        return $this->replaceRegex($find, $replace);
    }

    /**
     * @param string      $needle
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replaceFirst(string $needle, string $replace = null, $ignoreCase = false)
    {
        $value = $this->value;
        $this->value = (($pos = ($ignoreCase ? stripos($value, $needle) : strpos($value, $needle)))
                        !== false) ? substr_replace($value, $replace, $pos, strlen($needle)) : $value;

        return $this;
    }

    /**
     * @param string      $needle
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replaceLast(string $needle, string $replace = null, $ignoreCase = false)
    {
        $value = $this->value;
        $this->value = (($pos = ($ignoreCase ? strripos($value, $needle) : strrpos($value, $needle)))
                        !== false) ? substr_replace($value, $replace, $pos, strlen($needle)) : $value;

        return $this;
    }

    /**
     * @param string $suffix
     * @param bool   $ifNotExists
     * @param bool   $ignoreCase
     * @return $this
     */
    private function suffix(string $suffix, $ifNotExists = false, $ignoreCase = false)
    {
        $value = $this->value;
        $this->value = $ifNotExists && $this->endsWith($suffix, $ignoreCase) ? $value : $value . $suffix;

        return $this;
    }

    /**
     * @param string $prefix
     * @param bool   $ifNotExists
     * @param bool   $ignoreCase
     * @return $this
     */
    private function prefix(string $prefix, $ifNotExists = false, $ignoreCase = false)
    {
        $value = $this->value;
        $this->value = $ifNotExists && $this->startsWith($prefix, $ignoreCase) ? $value : $prefix . $value;

        return $this;
    }

    /**
     * @param string      $find
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replaceSuffix(string $find, string $replace = null, $ignoreCase = false)
    {
        $value = $this->value;
        $this->value = $this->endsWith($find, $ignoreCase) ? (string)$this->replaceLast($find, $replace,
            $ignoreCase) : $value;

        return $this;
    }

    /**
     * @param string      $find
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replacePrefix(string $find, string $replace = null, $ignoreCase = false)
    {
        $value = $this->value;
        $this->value = $this->startsWith($find, $ignoreCase) ? (string)$this->replaceFirst($find, $replace,
            $ignoreCase) : $value;

        return $this;
    }

    /**
     * @param string      $first
     * @param string|null $last
     * @param bool        $ignoreCase
     * @return $this
     */
    private function betweenGreedy(string $first, string $last = null, $ignoreCase = false)
    {
        $value = $this->value;
        if ($last === null) {
            $last = $first;
        }
        $this->value = (string)$this->beforeLast($last, $ignoreCase);
        $this->value = (string)$this->afterFirst($first, $ignoreCase);

        return $this;
    }

    /**
     * @param string      $first
     * @param string|null $last
     * @param bool        $ignoreCase
     * @return $this
     */
    private function between(string $first, string $last = null, $ignoreCase = false)
    {
        $value = $this->value;
        if ($last === null) {
            $last = $first;
        }
        $this->value = (string)$this->afterFirst($first, $ignoreCase);
        $this->value = (string)$this->beforeFirst($last, $ignoreCase);

        return $this;
    }

    /**
     * @param string      $first
     * @param string|null $last
     * @param bool        $ignoreCase
     * @return $this
     */
    private function betweenLazy(string $first, string $last = null, $ignoreCase = false)
    {
        $value = $this->value;
        if ($last === null) {
            $last = $first;
        }
        $this->value = (string)$this->beforeLast($last, $ignoreCase);
        $this->value = (string)$this->afterLast($first, $ignoreCase);

        return $this;
    }

    /**
     * @param string $toMatch
     * @param bool   $ignoreCase
     * @return bool
     */
    private function equals(string $toMatch, $ignoreCase = false)
    {
        $value = $this->value;
        return boolval($ignoreCase ? strtolower($value) === strtolower($toMatch) : $value === $toMatch);
    }

    /**
     * @param string|null $delim
     * @param bool        $ignoreEmpty
     * @return array|false|string[]
     */
    private function words(string $delim = null, $ignoreEmpty = false)
    {
        $value = $this->value;
        $split = !is_null($delim) ? preg_split($delim, $value) : preg_split('/(\s[\W]\s|[\s])/', $value);
        if (!$ignoreEmpty) {
            return $split;
        }
        $return = [];
        foreach ($split as $word) {
            if (strlen($word)) {
                $return[] = $word;
            }
        }

        return $return;
    }

    /**
     * @param string|null $delim
     * @param bool        $ignoreEmpty
     * @return int
     */
    private function wordCount(string $delim = null, $ignoreEmpty = false)
    {
        $value = $this->value;
        return count($this->words($delim, $ignoreEmpty));
    }

    /**
     * @return array
     */
    private function characters()
    {
        $value = $this->value;
        return str_split($value);
    }

    /**
     * @return int
     */
    private function length()
    {
        $value = $this->value;
        return strlen($value);
    }

    /**
     * @return $this
     */
    private function html()
    {
        $value = $this->value;
        $this->value = htmlspecialchars($value, ENT_QUOTES);

        return $this;
    }

    /**
     * @param string $newline
     * @return $this
     */
    private function newline($newline = "\n")
    {
        $value = $this->value;
        $this->value = preg_replace('/\R/u', $newline, $value);

        return $this;
    }

    /**
     * @return $this
     */
    private function reverse()
    {
        $value = $this->value;
        $this->value = strrev($value);

        return $this;
    }

    /**
     * @param bool   $outputCapitalised
     * @param bool   $ignoreLowerCase
     * @return $this
     */
    private function acronym($outputCapitalised = false, $ignoreLowerCase = false)
    {
        $value = $this->value;
        $str = '';
        foreach ($this->words() as $word) {
            if (!$ignoreLowerCase || ($ignoreLowerCase && $word[0] == strtoupper($word[0]))) {
                $str .= $word[0];
            }
        }
        $this->value = $outputCapitalised ? strtoupper($str) : $str;

        return $this;
    }

    /**
     * @return $this
     */
    private function parseDir()
    {
        $return = $this->value;
        foreach (func_get_args() as $str) {
            if (!is_array($str))
                $str = [$str];
            foreach ($str as $string) {
                if ($string == '' || $string == null || $string == false) {
                    continue;
                }
                $return .= '/' . trim($string, '/');
            }
        }
        $this->value = $return;

        return $this;
    }

    /**
     * @return $this
     */
    private function stripExtension()
    {
        $value = $this->value;
        $this->value = preg_replace('/\.([a-z0-9]+)$/i', '', $value);

        return $this;
    }

    /**
     * @return $this
     */
    private function hasExtension()
    {
        $value = $this->value;
        return boolval(preg_match('/\.([a-z0-9]+)$/i', $value));
    }

    /**
     * @param mixed $default
     * @return $this
     */
    private function getExtension($default = null)
    {
        $value = $this->value;
        preg_match('/\.([a-z0-9]+)$/i', $value, $m);
        return isset($m[1]) ? $m[1] : $default;
    }

    /**
     * @return $this
     */
    private function url()
    {
        $value = $this->value;
        $this->value = trim(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $value)), '-');

        return $this;
    }

    private function normalCase() {
        $value = $this->value;
        if ($this->contains(' ')) {

        }elseif ($this->contains('_')) {
            $value = preg_replace('/_/', ' ', $value);
        }else{
            $words = preg_split('/(?=[A-Z]|\W)/',$value);
            preg_match_all('/((?:^|[A-Z])[a-z]+)/',implode(' ', $words), $matches);
            $value = implode(' ', $matches[0]);
            $value = preg_replace('/\W+/', ' ', $value);
        }
        $value = strtolower($value);
        return $value;
    }

    /**
     * @return $this
     */
    private function camelCase() {
        $value = $this->normalCase();

        $words = array_map('ucfirst', explode(' ', $value));
        $this->value = lcfirst(implode('', $words));

        return $this;
    }

    /**
     * @return $this
     */
    private function pascalCase() {
        $this->value = ucfirst($this->camelCase());

        return $this;
    }

    /**
     * @return $this
     */
    private function snakeCase() {
        $value = $this->normalCase();
        $this->value = preg_replace('/\W/', '_', $value);

        return $this;
    }

    /**
     * @return bool
     */
    private function isCamelCase() {
        $value = $this->value;
        return $value==$this->camelCase();
    }

    /**
     * @return bool
     */
    private function isPascalCase() {
        $value = $this->value;
        return $value==$this->pascalCase();
    }

    /**
     * @return bool
     */
    private function isSnakeCase() {
        $value = $this->value;
        return $value==$this->snakeCase();
    }


}