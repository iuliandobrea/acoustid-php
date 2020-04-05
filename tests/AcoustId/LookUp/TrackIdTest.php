<?php

namespace Tests\AcoustId\LookUp;

use AcoustId\LookUp\TrackId;
use Tests\TestCase;

/**
 * Class TrackIdTest
 *
 * @package Tests\AcoustId
 */
class TrackIdTest extends TestCase
{
    /**
     * @var TrackId
     */
    protected $instance;

    /**
     * @var string
     */
    protected $trackId;

    /**
     * TrackIdTest constructor.
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
        $this->instance = new class(getenv('API_APPLICATION_TOKEN')) extends TrackId {
        };

        $this->trackId = '9ff43b6a-4f16-427c-93c2-92307ca505e0';
    }

    /**
     * @covers \AcoustId\LookUp\TrackId::setTrackId
     * @covers \AcoustId\LookUp\TrackId::getTrackId
     */
    public function testSetTrackId(): void
    {
        $this->instance->setTrackId($this->trackId);
        $this->assertEquals($this->trackId, $this->instance->getTrackId());
    }

    /**
     * @covers \AcoustId\LookUp\TrackId::setTrackId
     * @covers \AcoustId\LookUp\TrackId::getTrackId
     */
    public function testSetTrackIdFail(): void
    {
        $this->expectException(\TypeError::class);
        $this->instance->setTrackId(null);
        $this->assertEquals((string) null, $this->instance->getTrackId());
    }

    /**
     * @throws \AcoustId\Exceptions\HttpException
     * @covers \AcoustId\LookUp\TrackId::lookUp
     */
    public function testLookUp(): void
    {
        $result = $this->instance->lookUp($this->trackId);
        $this->isSuccessfulResult($result);
    }
}
