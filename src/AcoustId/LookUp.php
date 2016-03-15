<?php namespace AcoustId;

use AcoustId\Traits\CheckRequiredParameters;

/**
 * Class LookUp
 *
 * @package AcoustId
 * @property $requiredParameters
 */
abstract class LookUp
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
     * JSONP callback, only applicable if you select the jsonp format
     * Possible values are: jsonAcoustidApi
     *
     * @required no
     * @var string
     */
    protected $jsonCallBack = 'jsonAcoustidApi';

    /**
     * Application's API key
     *
     * @required yes
     * @var string
     */
    protected $clientId;

    /**
     * Returned metadata.
     * Possible values are: $metaAllowedValues
     *
     * @required no
     * @var array
     */
    protected $meta;

    /**
     * Allowed $meta values
     *
     * @var array
     */
    private $metaAllowedValues = ['recordings', 'recordingids', 'releases', 'releaseids', 'releasegroups', 'releasegroupids', 'tracks', 'compress', 'usermeta', 'sources'];

    /**
     * AcoustId API base url.
     *
     * @var string
     */
    protected $url = 'http://api.acoustid.org/v2/lookup';

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
     * Set required meta info.
     * See: $metaAllowedValues
     *
     * @param array $meta
     *
     * @return $this
     * @throws Exception
     */
    public function setMeta($meta)
    {
        if (empty($meta) or !is_array($meta)) {
            throw new Exception('$meta parameter must be an array');
        }
        foreach ($meta as $item) {
            if (!in_array($item, $this->metaAllowedValues)) {
                throw new Exception('Passed $meta (' . $item . ') member is not in list of allowed values. Allowed: ' . join(', ', $this->metaAllowedValues));
            }

            $this->meta[] = (string) $item;
        }

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
     * Get client API token
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Get response info meta
     * See: $metaAllowedValues
     *
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }
}