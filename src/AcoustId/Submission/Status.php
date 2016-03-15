<?php namespace AcoustId\Submission;

use AcoustId\Exception;
use AcoustId\Traits\CheckRequiredParameters;

/**
 * Class Status
 *
 * @package AcoustId\Submission
 */
class Status
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
    private $formatAllowedValues = ['json', 'xml'];

    /**
     * Application's API key
     *
     * @required yes
     * @var string
     */
    protected $clientId;

    /**
     * application's version
     *
     * @required no
     * @var string
     */
    protected $clientVersion = '1.0';

    /**
     * Submission ID, can be used multiple times
     *
     * @var int
     */
    protected $id;

    /**
     * Request url
     *
     * @var string
     */
    protected $url = 'http://api.acoustid.org/v2/submission_status';

    /**
     * Array of required parameters for request
     *
     * @var array
     */
    protected $requiredParameters = [
        'id',
    ];

    /**
     * Status constructor.
     *
     * @param int $id - id of submission
     */
    public function __construct($id)
    {
        $this->setId($id);
    }

    /**
     * Set response format
     *
     * @param string $format
     *
     * @return $this
     * @throws Exception
     */
    public function setFormat($format)
    {
        if (!in_array($format, $this->formatAllowedValues)) {
            throw new Exception('Passed $format value is not in list of allowed values. Allowed: ' . join(', ', $this->formatAllowedValues));
        }

        $this->format = (string) $format;

        return $this;
    }

    /**
     * Set client version
     *
     * @param string $clientVersion
     *
     * @return $this
     */
    public function setClientVersion($clientVersion)
    {
        $this->clientVersion = (string) $clientVersion;

        return $this;
    }

    /**
     * Set clientId parameter
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
     * Set submission id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Get client version
     *
     * @return string
     */
    public function getClientVersion()
    {
        return $this->clientVersion;
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

    /**
     * Get submission id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Get request url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}