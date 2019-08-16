<?php

namespace AcoustId;

use AcoustId\Exceptions\InvalidArgumentException;
use AcoustId\Exceptions\UnexpectedValueException;

/**
 * Class AcoustId
 *
 * @package AcoustId
 */
abstract class AcoustId
{

    /**
     * API client key
     *
     * @var string
     */
    protected $clientAPIToken;

    /**
     * Response format. json, jsonp or xml. Default is json.
     *
     * @required no
     * @var string
     */
    protected $responseType = 'json';

    /**
     * JSONP callback, only applicable if you select the jsonp format
     *
     * @required no
     * @var string
     */
    protected $jsonCallBack;

    /**
     * API url for making requests
     *
     * @var string
     */
    protected $apiUrl;

    /**
     * AcoustId constructor.
     *
     * @param string $token
     *
     * @throws UnexpectedValueException
     */
    public function __construct(string $token)
    {
        if (empty($token)) {
            throw new UnexpectedValueException('Client API token can not be empty.');
        }

        $this->clientAPIToken = $token;
    }

    /**
     * @return $this
     */
    public function setJSONResponseType()
    {
        $this->responseType = 'json';

        return $this;
    }

    /**
     * @param string $callback
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setJSONPResponseType(string $callback = 'jsonAcoustidApi')
    {
        if (empty($callback)) {
            throw new InvalidArgumentException('JSONP $callback parameter can not be empty.');
        }

        $this->responseType = 'jsonp';
        $this->jsonCallBack = (string) $callback;

        return $this;
    }

    /**
     * @return $this
     */
    public function setXMLResponseType()
    {
        $this->responseType = 'xml';

        return $this;
    }

    /**
     * Get response type
     * See: $formatAllowedValues
     *
     * @return string
     */
    public function getResponseType(): string
    {
        return $this->responseType;
    }

    /**
     * Get json callback
     *
     * @return string
     */
    public function getJsonCallBack(): string
    {
        return $this->jsonCallBack;
    }

    /**
     * @return string
     */
    public function getClientAPIToken(): string
    {
        return $this->clientAPIToken;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $url
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setAPIUrl(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Given $url parameter is not a valid url.');
        }

        $this->apiUrl = (string) $url;

        return $this;
    }
}