<?php namespace AcoustId;

use AcoustId\Traits\CheckRequiredParameters;

/**
 * Class ListByMDID
 *
 * @package AcoustId
 * @property $requiredParameters
 */
class ListByMDID
{

    use CheckRequiredParameters;

    /**
     * Response format.
     * Possible values are: $formatAllowedValues
     *
     * @required no
     * @var string
     */
    protected $format = 'json';

    /**
     * Allowed $format values.
     *
     * @var array
     */
    private $formatAllowedValues = ['json', 'jsonp', 'xml'];

    /**
     * Application's API key
     *
     * @required yes
     * @var string
     */
    protected $clientId;

    /**
     * JSONP callback, only applicable if you select the jsonp format
     * Possible values are: jsonAcoustidApi
     *
     * @required no
     * @var string
     */
    protected $jsonCallBack = 'jsonAcoustidApi';

    /**
     * Corresponding MusicBrainz recording ID (can be sent multiple times)
     * String for single request and array for batch requests
     *
     * @required yes
     * @var string|array
     */
    protected $mbid;

    /**
     * Array of required parameters for request
     *
     * @var array
     */
    protected $requiredParameters = [
        'mbid',
    ];

    /**
     * Use if you want to lookup multiple MBIDs. 0 or 1
     *
     * @var int
     */
    protected $batch = 0;

    /**
     * AcoustId API base url.
     *
     * @var string
     */
    protected $url = 'http://api.acoustid.org/v2/track/list_by_mbid';

    /**
     * ListByMDID constructor.
     *
     * @param string $mbid
     */
    public function __construct($mbid)
    {
        $this->setMBID($mbid);
    }

    /**
     * Set response format.
     * See: $formatAllowedValues
     *
     * @param string $format
     *
     * @return $this
     * @throws Exception
     */
    public function setFormat($format = 'json')
    {
        if (!in_array($format, $this->formatAllowedValues)) {
            throw new Exception('Passed $format value is not in list of allowed values. Allowed: ' . join(', ', $this->formatAllowedValues));
        }

        if ($format == 'jsonp') {
            $this->setJsonCallBack();
            $this->format = (string) $format;
        }

        $this->format = (string) $format;

        return $this;
    }

    /**
     * Set JSON callback. Response will be wrapped with this function. Used when format is set to jsonp.
     * See: https://ru.wikipedia.org/wiki/JSONP
     *
     * @param string $jsonCallBack
     *
     * @return $this
     */
    public function setJsonCallBack($jsonCallBack = 'jsonAcoustidApi')
    {
        $this->jsonCallBack = (string) $jsonCallBack;

        return $this;
    }

    /**
     * Set MBID
     *
     * @param string|array $mbid
     */
    public function setMBID($mbid)
    {
        if (is_array($mbid)) {
            $this->setBatch(1);
        }

        $this->mbid = $mbid;
    }

    /**
     * Set the client id
     *
     * @param string $clientId
     *
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = (string) $clientId;

        return $this;
    }

    /**
     * Set request url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = (string) $url;

        return $this;
    }

    /**
     * Set the batch request
     *
     * @param int $batch
     */
    public function setBatch($batch)
    {
        $this->batch = (int) $batch;
    }

    /**
     * Get request url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get response format
     * See: $formatAllowedValues
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Get json callback
     *
     * @return string
     */
    public function getJsonCallBack()
    {
        return $this->jsonCallBack;
    }

    /**
     * Get MBID
     *
     * @return string
     */
    public function getMBID()
    {
        return $this->mbid;
    }

    /**
     * Get the state of batch request
     *
     * @return int
     */
    public function getBatch()
    {
        return $this->batch;
    }

    /**
     * Get clientId API token
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }
}