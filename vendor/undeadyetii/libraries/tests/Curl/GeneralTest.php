<?php

namespace Yetii\Tests\Curl;

use PHPUnit\Framework\TestCase;
use YeTii\Applications\Curl;

/**
 * Class GeneralTest
 */
class GeneralTest extends TestCase
{
    /**
     * @var string
     */
    public $testData = 'https://google.com';

    /**
     * @var Curl
     */
    public $curlClient;

    /**
     * GeneralTest constructor.
     * @param mixed|null $name
     * @param array      $data
     * @param string     $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->curlClient = new Curl($this->testData);
        $this->curlClient->execute();
    }

    /**
     * Check that the cURL request returns a valid string
     */
    public function testCanFetchCurlResponseData()
    {
        // Check that response is returned as a string
        $this->assertInternalType('string', $this->curlClient->response());
        $this->assertInternalType('string', $this->curlClient->response());
    }

    /**
     * Check that the header is returned as a valid header string
     */
    public function testCanFetchResponseHeader()
    {
        $this->assertInternalType('string', $this->curlClient->header());
        $this->assertContains('Content-Type: text/html; charset=UTF-8', $this->curlClient->header());
    }

    /**
     * Check that there are no errors
     */
    public function testCanFetchResponseErrors()
    {
        $this->assertInternalType('string', $this->curlClient->error());
        $this->assertTrue($this->curlClient->error() === '');
    }

    /**
     * Check that the HTTP response code is an integer
     */
    public function testCanFetchResponseCode()
    {
        $this->assertInternalType('int', $this->curlClient->httpCode());
    }

    /**
     * Check that the HTTP response time (latency) is a float
     */
    public function testCanFetchResponseTime()
    {
        $this->assertInternalType('float', $this->curlClient->latency());
    }
}