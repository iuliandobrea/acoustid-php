<?php

namespace Tests\AcoustId;

use AcoustId\AcoustId;
use AcoustId\Exceptions\InvalidArgumentException;
use Tests\TestCase;

/**
 * Class AcoustIdTest
 *
 * @package Tests\AcoustId
 */
class AcoustIdTest extends TestCase
{
    /**
     * @var AcoustId
     */
    protected $instance;

    /**
     * AcoustIdTest constructor.
     *
     * @param string|null $name
     * @param array       $data
     * @param string      $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     *
     */
    protected function setUp(): void
    {
        $this->instance = new class(getenv('API_APPLICATION_TOKEN')) extends AcoustId {
        };
    }

    /**
     * @covers \AcoustId\AcoustId::setJSONResponseType
     */
    public function testSetJSONResponseType(): void
    {
        $this->instance->setJSONResponseType();
        $this->assertEquals('json', $this->instance->getResponseType());
    }

    /**
     * @throws InvalidArgumentException
     * @covers \AcoustId\AcoustId::setJSONPResponseType
     * @covers \AcoustId\AcoustId::getJsonCallBack
     * @covers \AcoustId\AcoustId::getResponseType
     */
    public function testSetJSONPResponseType(): void
    {
        $this->instance->setJSONPResponseType('callback_function');
        $this->assertEquals('jsonp', $this->instance->getResponseType());
        $this->assertEquals('callback_function', $this->instance->getJsonCallBack());

        $this->expectException(InvalidArgumentException::class);
        $this->instance->setJSONPResponseType('');
    }

    /**
     * @covers \AcoustId\AcoustId::setXMLResponseType
     */
    public function testSetXMLResponseType(): void
    {
        $this->instance->setXMLResponseType();
        $this->assertEquals('xml', $this->instance->getResponseType());
    }

    /**
     * @covers \AcoustId\AcoustId::getClientAPIToken
     */
    public function testGetClientAPIToken(): void
    {
        $this->assertEquals(getenv('API_APPLICATION_TOKEN'), $this->instance->getClientAPIToken());
    }

    /**
     * @throws InvalidArgumentException
     * @covers \AcoustId\AcoustId::setAPIUrl
     * @covers \AcoustId\AcoustId::getApiUrl
     */
    public function testSetGetApiUrl(): void
    {
        $this->instance->setAPIUrl('http://some.api.url');
        $this->assertEquals('http://some.api.url', $this->instance->getApiUrl());
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testSetBadAPIUrl(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->instance->setAPIUrl('not-url');
    }
}
