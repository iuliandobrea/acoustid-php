<?php namespace Tests\AcoustId\Request;

use AcoustId\Request\Submission;
use Tests\AcoustId\AcoustIdTestCase;

/**
 * Class TestSubmission
 *
 * @package Tests\AcoustId\Request
 */
class SubmissionTest extends AcoustIdTestCase
{

    /**
     * @var Submission
     */
    protected $submissionRequest;

    /**
     * @var \AcoustId\Submission
     */
    protected $submission;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public function setUp()
    {
        parent::setUp();

        $this->submission        = new \AcoustId\Submission(API_USERID_TOKEN, $this->duration, $this->fingerPrint);
        $this->submissionRequest = new Submission($this->submission);
    }

    public function testInstanceTypes()
    {
        $this->assertInstanceOf(\AcoustId\Submission::class, $this->submission);
        $this->assertInstanceOf(Submission::class, $this->submissionRequest);
    }

    public function testCreateRequest()
    {
        $this->submissionRequest->createRequest();

        $params = $this->submissionRequest->getParams();

        $this->assertEquals($this->submission->getClientId(), $params['client']);
        $this->assertEquals($this->submission->getUser(), $params['user']);
        $this->assertEquals($this->submission->getDuration(), $params['duration']);
        $this->assertEquals($this->submission->getFingerPrint(), $params['fingerprint']);
        $this->assertEquals($this->submission->getFormat(), $params['format']);
        $this->assertEquals($this->submission->getClientVersion(), $params['clientversion']);
        $this->assertEquals($this->submission->getWait(), $params['wait']);
        $this->assertEquals($this->submission->getBitRate(), $params['bitrate']);
        $this->assertEquals($this->submission->getFileFormat(), $params['fileformat']);
        $this->assertEquals($this->submission->getMBID(), $params['mbid']);
        $this->assertEquals($this->submission->getTrack(), $params['track']);
        $this->assertEquals($this->submission->getArtist(), $params['artist']);
        $this->assertEquals($this->submission->getAlbum(), $params['album']);
        $this->assertEquals($this->submission->getAlbumArtist(), $params['albumartist']);
        $this->assertEquals($this->submission->getYear(), $params['year']);
        $this->assertEquals($this->submission->getTrackNo(), $params['trackno']);
        $this->assertEquals($this->submission->getDiscNo(), $params['discno']);
    }

}