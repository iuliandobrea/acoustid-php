<?php namespace Tests\AcoustId;

use AcoustId\LookUp\FingerPrint;
use AcoustId\LookUp\TrackId;
use AcoustId\Submission;
use AcoustId\Submission\Status;

/**
 * Class TestAcoustId
 *
 * @package Tests\AcoustId
 */
class AcoustIdTest extends AcoustIdTestCase
{
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
    }

    /**
     * @dataProvider providerTestSubmission
     * @covers       AcoustId\AcoustId::submission
     *
     * @param \AcoustId\Submission $submission
     */
    public function testSubmission($submission)
    {
        $this->assertInstanceOf(Submission::class, $submission);
        $response = $this->client->submission($submission);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return array
     */
    public function providerTestSubmission()
    {
        return [
            [new \AcoustId\Submission(API_USERID_TOKEN, $this->duration, $this->fingerPrint)],
        ];
    }

    /**
     * @dataProvider providerTestSubmissionStatus
     * @covers       AcoustId\AcoustId::submissionStatus
     *
     * @param Status $submissionStatus
     */
    public function testSubmissionStatus($submissionStatus)
    {
        $this->assertInstanceOf(Status::class, $submissionStatus);
        $response = $this->client->submissionStatus($submissionStatus);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return array
     */
    public function providerTestSubmissionStatus()
    {
        return [
            [new Status(155396581)],
        ];
    }

    /**
     * @dataProvider providerTestLookUpFingerPrint
     * @covers       AcoustId\AcoustId::lookUp
     *
     * @param FingerPrint $lookUp
     */
    public function testLookFingerPrint($lookUp)
    {
        $this->assertInstanceOf(FingerPrint::class, $lookUp);
        $response = $this->client->lookUp($lookUp);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return array
     */
    public function providerTestLookUpFingerPrint()
    {
        return [
            [new FingerPrint($this->duration, $this->fingerPrint)],
        ];
    }

    /**
     * @dataProvider providerTestLookUpTrackId
     * @covers       AcoustId\AcoustId::lookUp
     *
     * @param TrackId $lookUp
     */
    public function testLookTrackId($lookUp)
    {
        $this->assertInstanceOf(TrackId::class, $lookUp);
        $response = $this->client->lookUp($lookUp);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return array
     */
    public function providerTestLookUpTrackId()
    {
        return [
            [new TrackId($this->trackId)],
        ];
    }
}