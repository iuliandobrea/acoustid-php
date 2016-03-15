<?php namespace Tests\AcoustId;

use AcoustId\LookUp\FingerPrint;
use AcoustId\LookUp\TrackId;
use AcoustId\Request;

/**
 * Class TestRequest
 *
 * @package Tests\AcoustId
 */
class RequestTest extends AcoustIdTestCase
{

    /**
     * @var FingerPrint
     */
    protected $flookUp;

    /**
     * @var TrackId
     */
    protected $tlookUp;

    /**
     * @var Request
     */
    protected $request;

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

        $this->flookUp = new FingerPrint($this->duration, $this->fingerPrint);
        $this->tlookUp = new TrackId($this->trackId);
    }

    public function testCreateRequestFingerPrint()
    {
        $this->request = new Request\LookUp($this->flookUp);
        $this->request->createRequest();
        $params = $this->request->getParams();
        $this->assertEquals($this->flookUp->getClientId(), $params['client']);
        $this->assertEquals($this->flookUp->getFormat(), $params['format']);
        $this->assertEquals($this->flookUp->getDuration(), $params['duration']);
        $this->assertEquals($this->flookUp->getFingerPrint(), $params['fingerprint']);
        if ($this->flookUp->getFormat() == 'jsonp') {
            $this->assertEquals($this->flookUp->getJsonCallBack(), $params['jsoncallback']);
        }
    }

    public function testCreateRequestTrackId()
    {
        $this->request = new Request\LookUp($this->tlookUp);
        $this->request->createRequest();
        $params = $this->request->getParams();
        $this->assertEquals($this->tlookUp->getClientId(), $params['client']);
        $this->assertEquals($this->tlookUp->getFormat(), $params['format']);
        $this->assertEquals($this->tlookUp->getTrackId(), $params['trackid']);
    }

    public function testUrl()
    {
        $this->request = new Request\LookUp($this->flookUp);
        $this->request->setUrl($this->flookUp->getUrl());
        $this->assertEquals($this->flookUp->getUrl(), $this->request->getUrl());

        $this->request = new Request\LookUp($this->tlookUp);
        $this->request->setUrl($this->tlookUp->getUrl());
        $this->assertEquals($this->tlookUp->getUrl(), $this->request->getUrl());
    }
}