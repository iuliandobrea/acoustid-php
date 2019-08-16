<?php

namespace AcoustId;

use AcoustId\Exceptions\AcoustIdException;
use AcoustId\Exceptions\HttpException;
use AcoustId\Exceptions\InvalidArgumentException;
use GuzzleHttp\Client;

/**
 * Class Request
 *
 * @package AcoustId
 * @property Client $requestClient
 */
abstract class Request
{

    /**
     * @var string
     */
    protected $requestUrl;

    /**
     * Options for constructing Guzzle client instance
     * http://docs.guzzlephp.org/en/stable/request-options.html
     *
     * @var array
     */
    protected $options = [];

    /**
     * @return mixed
     */
    abstract protected function composeQueryParameters(): array;

    /**
     * Request constructor.
     *
     * @param AcoustId|Submission $instance
     * @param array               $options
     */
    public function __construct($instance, array $options = [])
    {
        $this->options = array_merge_recursive([
            'base_uri' => $instance->getAPIUrl(),
            'query'    => [
                'json' => true,
            ],
        ], $options);

        $this->requestUrl = $instance->getAPIUrl();
    }

    /**
     * @param string $name
     *
     * @return Client
     * @throws AcoustIdException
     */
    public function __get(string $name)
    {
        if (empty($this->options['base_uri'])) {
            throw new AcoustIdException('API request url can not be empty.');
        }

        if (empty($this->options['query'])) {
            throw new AcoustIdException('Can not perform search requests without query parameters.');
        }

        return $this->requestClient = new Client($this->options);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function doRequest()
    {
        return $this->requestClient->get($this->requestUrl, $this->options);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws HttpException
     */
    public function send()
    {
        try {
            $response = $this->doRequest();

            return $response;
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param array $options
     *
     * @return $this
     * @throws AcoustIdException
     * @throws InvalidArgumentException
     */
    public function setOptions(array $options)
    {
        if (empty($options)) {
            throw new InvalidArgumentException('Can not use empty $options array');
        }

        $result = array_replace_recursive($this->options, $options);

        if (!is_array($result)) {
            throw new AcoustIdException('Can not merge configuration array.');
        }

        $this->options = $result;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param LookUp|Submission $instance
     *
     * @return array
     */
    protected function createBaseQueryString($instance): array
    {
        $query['format'] = $instance->getResponseType();
        $query['client'] = $instance->getClientAPIToken();

        return $query;
    }

    /**
     * @param array $query
     *
     * @return $this
     */
    protected function createFullQueryString(array $query)
    {
        $queryString = [];

        foreach ($query as $k => $v) {
            $queryString[] = $k . '=' . $v;
        }

        # Set query parameter as string to avoid encoding in Guzzle
        $this->options['query'] = join('&', $queryString);

        return $this;
    }

}