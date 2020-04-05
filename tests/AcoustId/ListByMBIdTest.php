<?php

namespace Tests\AcoustId;

use AcoustId\Exceptions\HttpException;
use AcoustId\ListByMBId;
use Tests\TestCase;

/**
 * Class ListByMBIdTest
 *
 * @package Tests\AcoustId
 */
class ListByMBIdTest extends TestCase
{

    /**
     * @var ListByMBId
     */
    protected $instance;

    /**
     * ListByMBIdTest constructor.
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
        $this->instance = new class(getenv('API_APPLICATION_TOKEN')) extends ListByMBId {
        };
    }

    /**
     * @covers \AcoustId\ListByMBId::setMBId
     * @covers \AcoustId\ListByMBId::getMBId
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     */
    public function testSetMBId(): void
    {
        $this->instance->setMBId('test');
        $this->assertEquals('test', $this->instance->getMBId());
    }

    /**
     * @covers \AcoustId\ListByMBId::search
     */
    public function testSearch(): void
    {
        $result = $this->instance->search('4e0d8649-1f89-44f3-91af-4c0dbee81f28');
        $this->isSuccessfulResult($result);
    }

    /**
     * @throws HttpException
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     * @covers \AcoustId\ListByMBId::search
     */
    public function testSearchFail()
    {
        $this->expectException(HttpException::class);
        $this->instance->search(uniqid());

        $this->assertEquals(400, $this->getExpectedExceptionCode());
    }
}
