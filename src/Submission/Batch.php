<?php

namespace AcoustId\Submission;

use AcoustId\Exceptions\BadMethodCallException;
use AcoustId\Exceptions\HttpException;
use AcoustId\Exceptions\UnexpectedValueException;
use AcoustId\Submission;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Batch
 *
 * @package AcoustId\Submission
 */
class Batch extends Submission
{

    /**
     * Batch data array
     * Each element in $batch[0,1,2...n] - is analogue of single submission
     *
     * @var array
     */
    protected $batch = [];

    /**
     * Batch constructor.
     *
     * @param string $token
     *
     * @throws UnexpectedValueException
     */
    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    /**
     * @return ResponseInterface|void
     * @throws BadMethodCallException
     */
    public function send()
    {
        throw new BadMethodCallException('Send method not allowed for batch submission. Use sendBatch(array $batch) instead.');
    }

    /**
     * @param array $batch
     *
     * @return ResponseInterface
     * @throws HttpException
     * @throws UnexpectedValueException
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     */
    public function sendBatch(array $batch = []): ResponseInterface
    {
        if (!empty($batch)) {
            $this->setBatch($batch);
        }

        try {
            $request = new \AcoustId\Request\Submission\Batch($this);

            return $request->send();
        } catch (ClientException $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param Submission $item
     *
     * @return $this
     */
    public function appendToBatch(Submission $item): self
    {
        array_push($this->batch, $item);

        return $this;
    }

    /**
     * @param array $batch
     *
     * @return $this
     */
    public function setBatch(array $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    /**
     * @return array
     */
    public function getBatch(): array
    {
        return $this->batch;
    }

}
