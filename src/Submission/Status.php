<?php

namespace AcoustId\Submission;

use AcoustId\AcoustId;
use AcoustId\Exceptions\BadMethodCallException;
use AcoustId\Exceptions\HttpException;
use AcoustId\Exceptions\InvalidArgumentException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Status
 *
 * @package AcoustId\Submission
 */
class Status extends AcoustId
{
    /**
     * Request url
     *
     * @var string
     */
    protected $apiUrl = 'https://api.acoustid.org/v2/submission_status';

    /**
     * Submission ID
     *
     * @var int
     */
    protected $id;

    /**
     * Status constructor.
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
     * @param int $id
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws HttpException
     * @throws \AcoustId\Exceptions\UnexpectedValueException
     * @throws InvalidArgumentException
     */
    public function find(int $id)
    {
        $this->setSubmissionId($id);

        try {
            $request = new \AcoustId\Request\Submission\Status($this);

            return $request->send();
        } catch (ClientException $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param string $callback
     *
     * @return AcoustId|void
     * @throws BadMethodCallException
     */
    public function setJSONPResponseType(string $callback = 'jsonAcoustidApi')
    {
        throw new BadMethodCallException('JSONP response type is unavailable for status requests.');
    }

    /**
     * @param int $id
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setSubmissionId(int $id)
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Submission id must be positive integer. ' . $id . ' given.');
        }

        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSubmissionId(): ?int
    {
        return $this->id;
    }
}
