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
     * @throws Exception
     */
    public function testSetFormat()
    {
        $this->status->setFormat('json');
        $this->assertEquals('json', $this->status->getFormat());

        $this->expectException(Exception::class);
        $this->status->setFormat('bad_format');
    }

    public function testSetClientVersion()
    {
        $this->status->setClientVersion('1.2');
        $this->assertEquals('1.2', $this->status->getClientVersion());
    }

    public function testSetClientId()
    {
        $this->status->setClientId($xVar = md5('clientId'));
        $this->assertEquals($xVar, $this->status->getClientId());
    }

    public function testSetId()
    {
        $this->status->setId(123456789);
        $this->assertEquals(123456789, $this->status->getId());
    }

    public function testSetUrl()
    {
        $this->status->setUrl('http://some.url');
        $this->assertEquals('http://some.url', $this->status->getUrl());
    }
}