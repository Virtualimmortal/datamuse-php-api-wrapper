<?php

namespace YeTii\DatamuseApi;

use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase
{
    /**
     * @var ApiClient
     */
    protected $apiClient;

    public function setUp()
    {
        $this->apiClient = new ApiClient();
    }

    public function testCanConstructApiClientClass()
    {
        $this->apiClient = new ApiClient();

        $this->assertInstanceOf(ApiClient::class, $this->apiClient);
    }

    public function testCanConstructApiClientClassWithCacheLifetime()
    {
        $this->apiClient = new ApiClient([
            'cache_lifetime' => 0,
        ]);

        $this->assertInstanceOf(ApiClient::class, $this->apiClient);
    }

    public function testCanSetSingleOptionSuccessfully()
    {
        $this->apiClient->setOpt(RhymeOpt::SPELLED_LIKE, 'elepant');

        $this->assertEquals('elepant', $this->apiClient->getParameter(RhymeOpt::SPELLED_LIKE));
    }

    public function testCanSetMultipleOptionSuccessfully()
    {
        $this->apiClient->setOpts([
            RhymeOpt::SPELLED_LIKE => 'elepant',
            RhymeOpt::SOUNDS_LIKE  => 'elepant',
        ]);

        $this->assertEquals('elepant', $this->apiClient->getParameter(RhymeOpt::SPELLED_LIKE));
        $this->assertEquals('elepant', $this->apiClient->getParameter(RhymeOpt::SOUNDS_LIKE));
    }

    public function testGetWordsReturnsEmptyWhenNoOptionsSpecified()
    {
        $this->apiClient->getWords();

        $data = $this->apiClient->getResult();

        $this->assertEmpty($data);
    }

    public function testGetParameterReturnsNullWithInvalidOption()
    {
        $this->assertNull($this->apiClient->getParameter('notActuallyReal'));
    }

    public function testCanGetWordsWithOption()
    {
        $this->apiClient->setOpt(RhymeOpt::SPELLED_LIKE, 'elepant');
        $this->apiClient->getWords();

        $data = $this->apiClient->getResult();

        $this->assertNotEmpty($data);
    }

    public function testCanGetWordsWithOptionMethod()
    {
        $this->apiClient->spelledLike('elepant');
        $this->apiClient->getWords();

        $data = $this->apiClient->getResult();

        $this->assertNotEmpty($data);
    }

    public function testCanRetrieveProtectedProperty()
    {
        $this->assertEmpty($this->apiClient->parameter);
    }

    public function testCanCallMethodWithNoContent()
    {
        $result = $this->apiClient->spelledLike();

        $this->assertInstanceOf(ApiClient::class, $result);
        $this->assertNotContains(RhymeOpt::SPELLED_LIKE, $result->parameters);
    }
}
