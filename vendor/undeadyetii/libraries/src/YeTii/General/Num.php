<?php

namespace YeTii\General;

/**
 * Class Num
 */
class Num
{

    public $value;
    private $tmp;

    /**
     * @param mixed $str
     */
    public function __construct($str = null) {
        if (!is_null($str) && is_numeric($str))
            $this->value = floatval($str)%1==0 ? intval($str) : floatval($str);
    }

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $arguments) {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }
    }

    /**
     * @param string $name
     * @param array $args
     * @return string|int|float|bool|null
     */
    public static function __callStatic($name, $arguments) {
        $n = new Num();
        return call_user_func_array([$n, $name], $arguments);
    }

    /**
     * @return string
     */
    public function __toString() {
        return strval($this->value);
    }

    /**
     * @return int
     */
    public function toInt() {
        return intval($this->value);
    }

    /**
     * @return int
     */
    public function toNatural() {
        return abs(intval($this->value));
    }

    /**
     * @return float
     */
    public function toFloat() {
        return floatval($this->value);
    }

    /**
     * @return float|int
     */
    public function value($default = null) {
        return is_numeric($this->value) ? ($this->value%1==0 ? intval($this->value) : floatval($this->value)) : $default;
    }

    /**
     * @param int $val
     * @return string
     */
    public static function toRomanNumerals()
    {
        $val = $this->toInt();
        $table = ['M'  => 1000,
                  'CM' => 900,
                  'D'  => 500,
                  'CD' => 400,
                  'C'  => 100,
                  'XC' => 90,
                  'L'  => 50,
                  'XL' => 40,
                  'X'  => 10,
                  'IX' => 9,
                  'V'  => 5,
                  'IV' => 4,
                  'I'  => 1
        ];
        $return = '';
        while ($val > 0) {
            foreach ($table as $rom => $arb) {
                if ($val >= $arb) {
                    $val -= $arb;
                    $return .= $rom;
                    break;
                }
            }
        }

        return $return;
    }

    /**
     * @param string $orig
     * @return bool|int|mixed
     */
    public static function romanNumeralsToInt(string $orig)
    {
        $string = strtoupper($orig);
        if (!preg_match('/^[IVXLCDM]+$/', $string)) {
            return false;
        }
        $numerals = ['M'  => 1000,
                     'CM' => 900,
                     'D'  => 500,
                     'CD' => 400,
                     'C'  => 100,
                     'XC' => 90,
                     'L'  => 50,
                     'XL' => 40,
                     'X'  => 10,
                     'IX' => 9,
                     'V'  => 5,
                     'IV' => 4,
                     'I'  => 1
        ];
        $result = 0;
        $blacklist = [];
        foreach ($numerals as $key => $value) {
            if (in_array($key, $blacklist)) {
                return false;
            }
            for ($i = 0; $i < 3; $i++) {  // max 3 in a row
                if (strpos($string, $key) === 0) {
                    $result += $value;
                    $string = substr($string, strlen($key));
                    if (strlen($key) == 2) {
                        $blacklist[] = $key[1];
                    }
                }
                if (!in_array($key, ['M', 'C', 'X', 'I'])) {
                    $i = 3;
                }
            }
            $blacklist[] = $key;
        }

        return $result;
    }

    /**
     * @param string $string
     * @return bool
     */
    public static function isRomanNumerals(string $string)
    {
        return boolval(self::romanNumeralsToInt($string));
    }

    /**
     * @param string $string
     * @return bool|float|int|null
     */
    public static function readMath(string $string)
    {
        if (preg_match('/^(\d+)\s*([\-\+\/\*])\s*(\d+)$/', $string, $m)) {
            return self::customEquation($m[1], $m[2], $m[3]);
        } else {
            return false;
        }
    }

    /**
     * @param $arg1
     * @param $modifier
     * @param $arg2
     * @return float|int|null
     */
    public static function customEquation($arg1, $modifier, $arg2)
    {
        switch ($modifier) {
            case '<':
                return $arg1 < $arg2;
            case '<=':
            case '=<':
            case '!>':
                return $arg1 <= $arg2;
            case '>':
                return $arg1 > $arg2;
            case '>=':
            case '=>':
            case '!<':
                return $arg1 >= $arg2;
            case '==':
            case '=':
                return $arg1 == $arg2;
            case '+':
                return $arg1 + $arg2;
            case '-':
                return $arg1 - $arg2;
            case '*':
            case '×':
                return $arg1 * $arg2;
            case '/':
            case '÷':
                return $arg1 / $arg2;
            case '^';
                return pow($arg1, $arg2);
            case '√':
                return sqrt($arg2);
            default:
                return null;
        }
    }

    /**
     * @param     $int
     * @param int $length
     * @return string
     */
    public static function padZero($length = 4)
    {
        $int = (string)$this;
        while (strlen($int) < $length) {
            $int = '0' . $int;
        }

        return $int;
    }


    /**
     * @return int|float
     */
    private function squareRoot() {
        return $this->nthRoot($this->value(0), 2);
    }

    /**
     * @param     $root
     * @return int|float
     */
    private function nthRoot($root) {
        return pow($this->value(0), 1/$root);
    }

    /**
     * @return bool
     */
    private function isPositive() {
        return $this->value(0)>0;
    }

    /**
     * @return bool
     */
    private function isNegative() {
        return $this->value(0)>0;
    }

    /**
     * @param     $val
     * @param     $by
     * @return obj
     */
    private function increment() {
        if (func_num_args()==1&&!is_null($this->value())) {
            $val = $this->value();
            $by = func_get_arg(0);
        }elseif(func_num_args()==0) {
            $val = $this->value();
            $by = 1;
        }elseif(func_num_args()==1) {
            $val = func_get_arg(0);
            $by = 1;
        }else{
            $val = func_get_arg(0);
            $by = func_get_arg(1);
        }

        $this->value = ($val+=$by);
        return $this;
    }

    /**
     * @param     $val
     * @param     $by
     * @return obj
     */
    private function decrement() {
        if (func_num_args()==1&&!is_null($this->value())) {
            $val = $this->value();
            $by = func_get_arg(0);
        }elseif(func_num_args()==0) {
            $val = $this->value();
            $by = 1;
        }elseif(func_num_args()==1) {
            $val = func_get_arg(0);
            $by = 1;
        }else{
            $val = func_get_arg(0);
            $by = func_get_arg(1);
        }

        $this->value = ($val-=$by);
        return $this;
    }

    /**
     * @param string  $from
     * @return obj
     */
    private function from(string $from) {
        $from = strtolower($from);
        if (!strlen($from)) return false;
        switch ($from[0]) {
            case 'b':
                $this->tmp = $this->value(0);
                break;
            case 'k':
                $this->tmp = $this->value(0)*1024;
                break;
            case 'm':
                $this->tmp = $this->value(0)*pow(1024, 2);
                break;
            case 'g':
                $this->tmp = $this->value(0)*pow(1024, 3);
                break;
            case 't':
                $this->tmp = $this->value(0)*pow(1024, 4);
                break;
            case 'p':
                $this->tmp = $this->value(0)*pow(1024, 5);
                break;
            default:
                $this->tmp = 0;
        }
        return $this;
    }

    /**
     * @param string  $to
     * @return obj
     */
    private function to(string $to) {
        $to = strtolower($to);
        if (!strlen($to)) return false;
        if (!is_numeric($this->tmp)) return false;
        switch ($to[0]) {
            case 'b':
                $this->value = $this->tmp;
                break;
            case 'k':
                $this->value = $this->tmp/1024;
                break;
            case 'm':
                $this->value = $this->tmp/pow(1024, 2);
                break;
            case 'g':
                $this->value = $this->tmp/pow(1024, 3);
                break;
            case 't':
                $this->value = $this->tmp/pow(1024, 4);
                break;
            case 'p':
                $this->value = $this->tmp/pow(1024, 5);
                break;
            default:
                $this->value = 0;
        }
        unset($this->tmp);
        return $this;
    }

    /**
     * @param int  $dp
     * @return float|int
     */
    private function round(int $dp = 0) {
        return round($this->value, $dp);
    }
}