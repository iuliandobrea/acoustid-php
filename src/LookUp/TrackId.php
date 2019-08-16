<?php

namespace AcoustId\LookUp;

use AcoustId\Exceptions\HttpException;
use AcoustId\LookUp;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class TrackId
 *
 * @package AcoustId\LookUp
 */
class TrackId extends LookUp
{

    /**
     * Track id (UUID) to search for
     *
     * @required yes
     * @var string
     */
    protected $trackId;

    /**
     * TrackId constructor.
     *
     * @param string $token
     *
     * @throws \AcoustId\Exceptions\UnexpectedValueException
     */
    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    /**
     * @param string $trackId
     *
     * @return ResponseInterface
     * @throws HttpException
     */
    public function lookUp(string $trackId): ResponseInterface
    {
        $this->setTrackId($trackId);

        try {
            $request = new \AcoustId\Request\TrackId($this);

            return $request->send();
        } catch (ClientException $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Set track id
     *
     * @param string $trackId
     *
     * @return $this
     */
    public function setTrackId($trackId)
    {
        $this->trackId = (string) $trackId;

        return $this;
    }

    /**
     * Get track id
     *
     * @return string
     */
    public function getTrackId(): string
    {
        return $this->trackId;
    }
}