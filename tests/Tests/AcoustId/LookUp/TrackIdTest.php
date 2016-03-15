<?php namespace Tests\AcoustId\LookUp;

use AcoustId\Exception;
use AcoustId\LookUp\TrackId;
use Tests\AcoustId\AcoustIdTestCase;

/**
 * Class TestTrackId
 *
 * @package Tests\AcoustId\LookUp
 */
class TrackIdTest extends AcoustIdTestCase
{

    /**
     * @var TrackId
     */
    protected $lookUp;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public function setUp()
    {
        parent::setUp();

        /** @var TrackId */
        $this->lookUp = new TrackId($this->trackId);
    }


    /**
     * @dataProvider dataProvider
     *
     * @param int $duration
     */
    public function testSetTrackId($duration)
    {
        $this->lookUp->setTrackId($duration);
        $this->assertEquals((string) $duration, $this->lookUp->getTrackId());
    }

    public function testGetTrackId()
    {
        $this->assertEquals($this->trackId, $this->lookUp->getTrackId());
    }

    /**
     * @throws Exception
     */
    public function testCheckRequiredParameters()
    {
        $this->lookUp->setClientId('someClientId');
        $this->lookUp->setTrackId('someFingerPrint');
        $this->assertTrue($this->lookUp->checkRequiredParameters());

        $this->lookUp->setClientId(null);
        $this->lookUp->setTrackId(null);
        $this->expectException(Exception::class);
        $this->lookUp->checkRequiredParameters();
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [1],
            [-2],
            ['test'],
            ['1abc'],
        ];
    }

}