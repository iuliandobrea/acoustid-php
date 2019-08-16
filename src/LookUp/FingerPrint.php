<?php

namespace AcoustId\LookUp;

use AcoustId\Exceptions\HttpException;
use AcoustId\Exceptions\InvalidArgumentException;
use AcoustId\LookUp;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class FingerPrint extends LookUp
{

    /**
     * Duration of the whole audio file in seconds
     *
     * @required yes
     * @var int
     */
    protected $duration;

    /**
     * Audio fingerprint data to search for
     *
     * @required yes
     * @var string
     */
    protected $fingerPrint;

    /**
     * FingerPrint constructor.
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
     * @param int    $duration
     * @param string $fingerPrint
     *
     * @return ResponseInterface
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function lookUp(int $duration, string $fingerPrint): ResponseInterface
    {
        $this->setDuration($duration);
        $this->setFingerPrint($fingerPrint);

        try {
            $request = new \AcoustId\Request\FingerPrint($this);

            return $request->send();
        } catch (ClientException $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param int $duration
     *
     * @return FingerPrint
     * @throws InvalidArgumentException
     */
    public function setDuration(int $duration): self
    {
        if (empty($duration) or $duration < 0) {
            throw new InvalidArgumentException('Duration can not be empty or less than zero.');
        }

        $this->duration = (int) $duration;

        return $this;
    }

    /**
     * @param string $fingerPrint
     *
     * @return FingerPrint
     * @throws InvalidArgumentException
     */
    public function setFingerPrint(string $fingerPrint): self
    {
        if (empty($fingerPrint)) {
            throw new InvalidArgumentException('Fingerprint can not be empty.');
        }

        $this->fingerPrint = (string) $fingerPrint;

        return $this;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return (int) $this->duration;
    }

    /**
     * @return string
     */
    public function getFingerPrint(): string
    {
        return (string) $this->fingerPrint;
    }
}