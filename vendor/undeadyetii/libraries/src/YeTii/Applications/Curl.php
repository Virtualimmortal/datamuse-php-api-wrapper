<?php

namespace YeTii\Applications;

/**
 * Class Curl
 */
class Curl
{
    /**
     * @var resource
     */
    protected $ch;
    /**
     * @var string
     */
    protected $responseHeader;
    /**
     * @var string
     */
    protected $responseBody;
    /**
     * @var string
     */
    protected $error;
    /**
     * @var int
     */
    protected $httpCode;
    /**
     * @var float
     */
    protected $latency;

    protected $http_methods = [
        'get', 'post', 'put', 'patch', 'delete', 'options', 'head'
    ];

    /**
     * Curl constructor.
     * @param string|null $url
     */
    public function __construct($url = null)
    {
        $this->ch = curl_init($url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Unknown) Gecko/20100101 Firefox/56.0');
        curl_setopt($this->ch, CURLOPT_HEADER, true);
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this|mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }elseif(in_array($name, $this->http_methods)) {
            $this->customrequest(strtoupper($name));
            foreach ($arguments as $arg) {
                if (is_array($arg)||is_object($arg)) {
                    foreach ($arg as $key => $value) {
                        $this->{$key}($value);
                    }
                }
            }
        } elseif (is_array($arguments) && !empty($arguments) && $const = @constant('CURLOPT_' . strtoupper($name))) {
            curl_setopt($this->ch, $const, $arguments[0]);
        }
        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $c = new Curl();

        return call_user_func_array([$c, $name], $arguments);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->response();
    }

    /**
     * @return $this
     */
    private function execute()
    {
        $latency = 0;
        $response = curl_exec($this->ch);
        $error = curl_error($this->ch);
        $http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $time = curl_getinfo($this->ch, CURLINFO_TOTAL_TIME);
        curl_close($this->ch);
        $this->responseHeader = substr($response, 0, $header_size);
        $this->responseBody = substr($response, $header_size);
        $this->error = $error;
        $this->httpCode = $http_code;
        $this->latency = round($time * 1000);

        return $this;
    }

    /**
     * @return mixed
     */
    private function response()
    {
        if ($this->expect_json) {
            if (strlen($this->responseBody) && $this->responseBody[0]=='{'){
                return json_decode($this->responseBody);
            }else{
                return new \StdClass;
            }
        }

        return $this->responseBody;
    }

    /**
     * @return mixed
     */
    private function header()
    {
        return $this->responseHeader;
    }

    /**
     * @return mixed
     */
    private function error()
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    private function httpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return mixed
     */
    private function latency()
    {
        return $this->latency;
    }

    private function expectJson($value = true) {
        $this->expect_json = boolval($value);
        return $this;
    }
}