<?php

namespace Tests\AcoustId;

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
    protected function setUp()
    {
        $this->instance = new class(getenv('API_APPLICATION_TOKEN')) extends ListByMBId
        {
        };
    }

    /**
     * @covers \AcoustId\ListByMBId::setMBId
     * @covers \AcoustId\ListByMBId::getMBId
     */
    public function testSetMBId()
    {
        $this->instance->setMBId('test');
        $this->assertEquals('test', $this->instance->getMBId());
    }

    /**
     * @covers \AcoustId\ListByMBId::search
     */
    public function testSearch()
    {
        $result = $this->instance->search('4e0d8649-1f89-44f3-91af-4c0dbee81f28');
        $this->assertEquals('ok', json_decode($result->getBody()->getContents())->status);
    }
}
