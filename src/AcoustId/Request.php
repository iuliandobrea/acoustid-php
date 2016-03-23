<?php namespace AcoustId;

use AcoustId\LookUp\FingerPrint;
use AcoustId\LookUp\TrackId;
use AcoustId\Submission\Batch;
use AcoustId\Submission\Status;
use GuzzleHttp\Client;

/**
 * Class Request
 *
 * @package AcoustId
 */
abstract class Request
{
    /**
     * @var FingerPrint|TrackId|Submission|Status|ListByMDID|Batch
     */
    protected $instance;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    protected $params;

    /**
     * Request constructor.
     *
     * @param FingerPrint|TrackId|Submission|Status|ListByMDID|Batch $instance
     */
    public function __construct($instance)
    {
        $this->instance = $instance;
    }

    /**
     * Create request based on $lookUp type
     */
    abstract public function createRequest();

    /**
     * Send request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send()
    {
        return (new Client())->get($this->url);
    }

    /**
     * Get query string url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set url
     *
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}