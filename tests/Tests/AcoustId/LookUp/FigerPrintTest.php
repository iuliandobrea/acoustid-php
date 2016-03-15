<?php namespace Tests\AcoustId\LookUp;

use AcoustId\Exception;
use AcoustId\LookUp\FingerPrint;
use Tests\AcoustId\AcoustIdTestCase;

/**
 * Class TestFingerPrint
 *
 * @package Tests\AcoustId\LookUp
 */
class FingerPrintTest extends AcoustIdTestCase
{
    /**
     * @var FingerPrint
     */
    protected $lookUp;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public function setUp()
    {
        parent::setUp();

        /** @var FingerPrint */
        $this->lookUp = new FingerPrint($this->duration, $this->fingerPrint);
    }

    /**
     * @dataProvider dataProvider
     * @covers       AcoustId\LookUp\FingerPrint::setDuration
     *
     * @param int $duration
     */
    public function testSetDuration($duration)
    {
        $this->lookUp->setDuration($duration);
        $this->assertEquals((int) $duration, $this->lookUp->getDuration());
    }

    /**
     * @covers AcoustId\LookUp\FingerPrint::getDuration
     */
    public function testGetDuration()
    {
        $this->assertEquals($this->duration, $this->lookUp->getDuration());
    }

    /**
     * @dataProvider dataProvider
     * @covers       AcoustId\LookUp\FingerPrint::setFingerPrint
     *
     * @param string $fingerPrint
     */
    public function testSetFingerPrint($fingerPrint)
    {
        $this->lookUp->setFingerPrint($fingerPrint);
        $this->assertEquals((string) $fingerPrint, $this->lookUp->getFingerPrint());
    }

    /**
     * @covers AcoustId\LookUp\FingerPrint::getFingerPrint
     */
    public function testGetFingerPrint()
    {
        $this->assertEquals($this->fingerPrint, $this->lookUp->getFingerPrint());
    }

    /**
     * @covers AcoustId\LookUp\FingerPrint::checkRequiredParameters
     * @throws Exception
     */
    public function testCheckRequiredParameters()
    {
        $this->lookUp->setClientId('someClientId');
        $this->lookUp->setFingerPrint('someFingerPrint');
        $this->lookUp->setDuration(100);
        $this->assertTrue($this->lookUp->checkRequiredParameters());

        $this->lookUp->setClientId(null);
        $this->lookUp->setDuration(null);
        $this->lookUp->setFingerPrint(null);
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