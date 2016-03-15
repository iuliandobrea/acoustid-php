<?php namespace Tests\AcoustId\Submission;

use AcoustId\Exception;
use AcoustId\Submission\Status;
use Tests\AcoustId\AcoustIdTestCase;

/**
 * Class TestStatus
 *
 * @package Tests\AcoustId\Request
 */
class StatusTest extends AcoustIdTestCase
{

    /**
     * @var Status
     */
    protected $status;

    /**
     *
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->status = new Status(155396581);
    }

    /**
     *
     */
    public function testInstanceTypes()
    {
        $this->assertInstanceOf(Status::class, $this->status);
    }

    /**
     * @covers AcoustId\Submission\Status::setFormat
     * @covers AcoustId\Submission\Status::getFormat
     * @throws Exception
     */
    public function testSetFormat()
    {
        $this->status->setFormat('json');
        $this->assertEquals('json', $this->status->getFormat());

        $this->expectException(Exception::class);
        $this->status->setFormat('bad_format');
    }

    /**
     * @covers AcoustId\Submission\Status::setClientVersion
     * @covers AcoustId\Submission\Status::getClientVersion
     */
    public function testSetClientVersion()
    {
        $this->status->setClientVersion('1.2');
        $this->assertEquals('1.2', $this->status->getClientVersion());
    }

    /**
     * @covers AcoustId\Submission\Status::setClientId
     * @covers AcoustId\Submission\Status::getClientId
     */
    public function testSetClientId()
    {
        $this->status->setClientId($xVar = md5('clientId'));
        $this->assertEquals($xVar, $this->status->getClientId());
    }

    /**
     * @covers AcoustId\Submission\Status::setId
     * @covers AcoustId\Submission\Status::getId
     */
    public function testSetId()
    {
        $this->status->setId(123456789);
        $this->assertEquals(123456789, $this->status->getId());
    }

    /**
     * @covers AcoustId\Submission\Status::setUrl
     * @covers AcoustId\Submission\Status::getUrl
     */
    public function testSetUrl()
    {
        $this->status->setUrl('http://some.url');
        $this->assertEquals('http://some.url', $this->status->getUrl());
    }
}