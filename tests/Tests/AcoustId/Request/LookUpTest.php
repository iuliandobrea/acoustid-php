<?php namespace Tests\AcoustId\Request;

use AcoustId\LookUp\FingerPrint;
use AcoustId\LookUp\TrackId;
use AcoustId\Request\LookUp;
use Tests\AcoustId\AcoustIdTestCase;

/**
 * Class TestLookUp
 *
 * @package Tests\AcoustId\Request
 */
class LookUpTest extends AcoustIdTestCase
{

    /**
     * @var FingerPrint
     */
    protected $fingerPrintLookUp;

    /**
     * @var LookUp
     */
    protected $requestFingerPrint;

    /**
     * @var TrackId
     */
    protected $trackIdLookUp;

    /**
     * @var LookUp
     */
    protected $requestTrackId;

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

        $this->fingerPrintLookUp  = new FingerPrint($this->duration, $this->fingerPrint);
        $this->requestFingerPrint = new LookUp($this->fingerPrintLookUp);

        $this->trackIdLookUp  = new TrackId($this->trackId);
        $this->requestTrackId = new LookUp($this->trackIdLookUp);
    }

    /**
     * @covers AcoustId\Request\LookUp::createRequest
     */
    public function testCreateFingerPrintRequest()
    {
        $this->requestFingerPrint->createRequest();

        $params = $this->requestFingerPrint->getParams();

        $this->assertEquals($this->fingerPrintLookUp->getClientId(), $params['client']);
        $this->assertEquals($this->fingerPrintLookUp->getFormat(), $params['format']);

        if ($params['format'] == 'jsonp') {
            $this->assertEquals($this->fingerPrintLookUp->getJsonCallBack(), $params['jsoncallback']);
        }

        if (!empty($params['meta'])) {
            $this->assertEquals($this->fingerPrintLookUp->getMeta(), $params['meta']);
        }

        $this->assertEquals($this->fingerPrintLookUp->getDuration(), $params['duration']);
        $this->assertEquals($this->fingerPrintLookUp->getFingerPrint(), $params['fingerprint']);
    }

    /**
     * @covers AcoustId\Request\LookUp::createRequest
     */
    public function testCreateTrackIdRequest()
    {
        $this->requestTrackId->createRequest();

        $params = $this->requestTrackId->getParams();

        $this->assertEquals($this->trackIdLookUp->getClientId(), $params['client']);
        $this->assertEquals($this->trackIdLookUp->getFormat(), $params['format']);
        if ($params['format'] == 'jsonp') {
            $this->assertEquals($this->trackIdLookUp->getJsonCallBack(), $params['jsoncallback']);
        }

        if (!empty($params['meta'])) {
            $this->assertEquals($this->trackIdLookUp->getMeta(), $params['meta']);
        }

        $this->assertEquals($this->trackIdLookUp->getTrackId(), $params['trackid']);
    }
}