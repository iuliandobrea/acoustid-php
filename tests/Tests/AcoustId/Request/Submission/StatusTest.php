<?php namespace Tests\AcoustId\Request\Submission;

use AcoustId\Request\Submission\Status;
use Tests\AcoustId\AcoustIdTestCase;

/**
 * Class TestStatus
 *
 * @package Tests\AcoustId\Request\Submission
 */
class StatusTest extends AcoustIdTestCase
{

    /**
     * @var \AcoustId\Submission\Status
     */
    protected $submissionStatus;

    /**
     * @var Status
     */
    protected $submissionStatusRequest;

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

        $this->submissionStatus        = new \AcoustId\Submission\Status(API_USERID_TOKEN, $this->duration, $this->fingerPrint);
        $this->submissionStatusRequest = new Status($this->submissionStatus);
    }

    public function testCreateRequest()
    {
        $this->submissionStatusRequest->createRequest();

        $params = $this->submissionStatusRequest->getParams();

        $this->assertEquals($this->submissionStatus->getClientId(), $params['client']);
        $this->assertEquals($this->submissionStatus->getFormat(), $params['format']);
        $this->assertEquals($this->submissionStatus->getClientVersion(), $params['clientversion']);
        $this->assertEquals($this->submissionStatus->getId(), $params['id']);
    }

    /**
     * @throws \AcoustId\Exception
     */
    public function testJsonResponse()
    {
        $this->submissionStatus->setClientId(API_CLIENT_TOKEN);
        $this->submissionStatus->setFormat('json');
        $response = $this->submissionStatusRequest->createRequest()->send();
        $this->assertTrue(strpos($response->getHeader('Content-Type')[0], 'json') !== false);
    }

    /**
     * @throws \AcoustId\Exception
     */
    public function testXmlResponse()
    {
        $this->submissionStatus->setClientId(API_CLIENT_TOKEN);
        $this->submissionStatus->setFormat('xml');
        $this->submissionStatusRequest = new Status($this->submissionStatus);
        $response                      = $this->submissionStatusRequest->createRequest()->send();
        $this->assertTrue(strpos($response->getHeader('Content-Type')[0], 'xml') !== false);
    }

}