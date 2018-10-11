<?php

namespace YeTii\DatamuseApi;

use PHPUnit\Framework\TestCase;

/**
 * Class ApiClientTest
 */
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

    /**
     * @test
     */
    public function canConstructApiClientClass()
    {
        $this->apiClient = new ApiClient();

        $this->assertInstanceOf(ApiClient::class, $this->apiClient);
    }

    /**
     * @test
     */
    public function canConstructApiClientClassWithCacheLifetime()
    {
        $this->apiClient = new ApiClient([
            'cache_lifetime' => 0,
        ]);

        $this->assertInstanceOf(ApiClient::class, $this->apiClient);
    }

    /**
     * @test
     */
    public function canSetSingleOptionSuccessfully()
    {
        $this->apiClient->setOpt(RhymeOpt::SPELLED_LIKE, 'elepant');

        $this->assertEquals('elepant', $this->apiClient->getParameter(RhymeOpt::SPELLED_LIKE));
    }

    /**
     * @test
     */
    public function canSetMultipleOptionSuccessfully()
    {
        $this->apiClient->setOpts([
            RhymeOpt::SPELLED_LIKE => 'elepant',
            RhymeOpt::SOUNDS_LIKE  => 'elepant',
        ]);

        $this->assertEquals('elepant', $this->apiClient->getParameter(RhymeOpt::SPELLED_LIKE));
        $this->assertEquals('elepant', $this->apiClient->getParameter(RhymeOpt::SOUNDS_LIKE));
    }

    /**
     * @test
     */
    public function getWordsReturnsEmptyWhenNoOptionsSpecified()
    {
        $this->apiClient->getWords();

        $data = $this->apiClient->getResult();

        $this->assertEmpty($data);
    }

    /**
     * @test
     */
    public function getParameterReturnsNullWithInvalidOption()
    {
        $this->assertNull($this->apiClient->getParameter('notActuallyReal'));
    }

    /**
     * @test
     */
    public function canGetWordsWithOption()
    {
        $this->apiClient->setOpt(RhymeOpt::SPELLED_LIKE, 'elepant');
        $this->apiClient->getWords();

        $data = $this->apiClient->getResult();

        $this->assertNotEmpty($data);
    }

    /**
     * @test
     */
    public function canGetWordsWithOptionMethod()
    {
        $this->apiClient->spelledLike('elepant');
        $this->apiClient->getWords();

        $data = $this->apiClient->getResult();

        $this->assertNotEmpty($data);
    }

    /**
     * @test
     */
    public function canRetrieveProtectedProperty()
    {
        $this->assertEmpty($this->apiClient->parameter);
    }

    /**
     * @test
     */
    public function canCallMethodWithNoContent()
    {
        $result = $this->apiClient->spelledLike();

        $this->assertInstanceOf(ApiClient::class, $result);
        $this->assertNotContains(RhymeOpt::SPELLED_LIKE, $result->parameters);
    }
}
